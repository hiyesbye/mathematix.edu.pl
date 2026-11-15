(() => {
 'use strict';
 const $=id=>document.getElementById(id), local=window.EscapeRoomLocal;
 let current=null,pin=null,busy=false,group=1;
 const drafts=new Map();
 const normalize=v=>v.trim().normalize('NFC').toLocaleUpperCase('pl-PL');
 function status(msg,error=false){$('status').textContent=msg;$('status').className='status '+(error?'error':'good')}
 function saved(){return current.groups.find(g=>g.group===group)}
 function rawFields(){return {numeric:$('numeric').value,letters:$('letters').value,mixed:$('mixed').value,message:$('message').value}}
 function remember(){if(!current)return;const d=rawFields(),base=saved();if(['numeric','letters','mixed','message'].some(k=>d[k]!==base[k]))drafts.set(group,{...d,revision:drafts.get(group)?.revision??base.revision});else drafts.delete(group);renderTabs()}
 function renderTabs(){document.querySelectorAll('[data-edit-group]').forEach(b=>{const n=Number(b.dataset.editGroup);b.setAttribute('aria-selected',String(n===group));b.tabIndex=n===group?0:-1;b.classList.toggle('dirty',drafts.has(n))});$('draftNote').textContent=drafts.has(group)?'Ta grupa ma niezapisane zmiany.':drafts.size?'Szkice w innych grupach: '+[...drafts.keys()].join(', '):'Wyświetlasz zapisaną konfigurację tej grupy.'}
 function renderGroup(){const d=drafts.get(group)||saved();for(const key of ['numeric','letters','mixed','message'])$(key).value=d[key];$('groupTitle').textContent='Kody dla grupy '+group;$('save').textContent='Zapisz grupę '+group;$('groupEditor').setAttribute('aria-labelledby','groupTab'+group);renderTabs()}
 function lock(){current=null;pin=null;drafts.clear();$('teacherForm').hidden=true;$('teacherForm').reset();$('currentPin').textContent='';$('loginPanel').hidden=false;$('loginPin').value='';status('Ustawienia zamknięte. Zaloguj administratora lub podaj PIN.')}
 function show(data){current=data;$('loginPanel').hidden=true;$('teacherForm').hidden=false;$('pinControls').hidden=!data.isAdmin;$('currentPin').textContent=data.isAdmin?data.pin:'';$('newPin').value=data.isAdmin?data.pin:'';$('newPin').required=!!data.isAdmin;$('accessLabel').textContent=local?'USTAWIENIA LOKALNE · OFFLINE':data.isAdmin?'ADMINISTRATOR MATHEMATIX':'DOSTĘP NAUCZYCIELA · PIN';renderGroup()}
 async function read(){if(local)return local.read(pin);const {data,error}=await sb.rpc('escape_room_groups_read',{p_pin:pin});if(error)throw new Error(error.code==='42501'?'Nieprawidłowy PIN lub brak uprawnień administratora.':'Nie udało się wczytać ustawień. Sprawdź połączenie.');return data}
 async function load(){const data=await read();drafts.clear();show(data);status('Wczytano aktualne ustawienia sześciu grup.')}
 function fields(){const c=rawFields();for(const key of ['numeric','letters','mixed'])c[key]=normalize(c[key]);c.message=c.message.trim();if(!/^\d{1,32}$/.test(c.numeric)||!/^[A-ZĄĆĘŁŃÓŚŹŻ]{1,32}$/.test(c.letters)||!/^[A-ZĄĆĘŁŃÓŚŹŻ0-9]{1,32}$/.test(c.mixed)||!c.message||c.message.length>160)throw new Error('Sprawdź format i długość kodów oraz wiadomość.');if(current.isAdmin&&!/^\d{4,12}$/.test($('newPin').value))throw new Error('PIN panelu nauczyciela musi zawierać 4–12 cyfr.');return c}
 async function save(){
  const c=fields(),args={p_group:group,p_numeric:c.numeric,p_letters:c.letters,p_mixed:c.mixed,p_message:c.message,p_revision:drafts.get(group)?.revision??saved().revision,p_pin:pin,p_new_pin:current.isAdmin&&$('newPin').value!==current.pin?$('newPin').value:null,p_pin_revision:current.pinRevision};
  let data;
  if(local){data=local.save(args);pin=data.pin;}
  else{const res=await sb.rpc('escape_room_group_save',args);if(res.error)throw new Error(res.error.code==='40001'?'Kody tej grupy lub PIN zmieniono w innym oknie. Wczytaj ponownie i sprawdź konfigurację przed zapisem.':res.error.code==='42501'?'Dostęp wygasł lub PIN został zmieniony. Otwórz ustawienia ponownie.':'Nie udało się zapisać konfiguracji. Sprawdź internet i format kodów.');data=res.data}
  drafts.delete(group);show(data);status('Zapisano grupę '+group+'. '+(local?'Zmiany dotyczą tego pliku i tej przeglądarki.':'Nowe kody działają na wszystkich urządzeniach online.'));
 }
 async function run(fn){if(busy)return;busy=true;document.querySelectorAll('#teacherForm button,#pinLogin button').forEach(b=>b.disabled=true);try{await fn()}catch(e){status(e.message,true)}finally{busy=false;document.querySelectorAll('#teacherForm button,#pinLogin button').forEach(b=>b.disabled=false)}}
 document.querySelectorAll('[data-edit-group]').forEach(b=>{b.onclick=()=>{if(busy||!current)return;remember();group=Number(b.dataset.editGroup);renderGroup()};b.onkeydown=e=>{const delta=e.key==='ArrowRight'?1:e.key==='ArrowLeft'?-1:0;if(!delta)return;e.preventDefault();$('groupTab'+((Number(b.dataset.editGroup)-1+delta+6)%6+1)).click();$('groupTab'+group).focus()}});
 for(const id of ['numeric','letters','mixed','message'])$(id).addEventListener('input',remember);
 $('pinLogin').onsubmit=e=>{e.preventDefault();run(async()=>{pin=$('loginPin').value;await load();$('loginPin').value=''})};$('teacherForm').onsubmit=e=>{e.preventDefault();run(save)};$('reload').onclick=()=>run(load);$('lock').onclick=lock;
 $('download').onclick=()=>run(async()=>{
  await save();
  let doc;if(local)doc=document.documentElement.cloneNode(true);else{const res=await fetch('escape-room-offline.html',{cache:'no-store'});if(!res.ok)throw new Error('Nie udało się pobrać pliku offline.');doc=new DOMParser().parseFromString(await res.text(),'text/html').documentElement;}
  doc.querySelector('#boot-config').textContent=JSON.stringify({groups:current.groups,pin:current.isAdmin?current.pin:pin,pinRevision:current.pinRevision,configured:true}).replace(/</g,'\\u003c');doc.querySelectorAll('dialog').forEach(d=>d.removeAttribute('open'));doc.querySelectorAll('input').forEach(i=>i.removeAttribute('value'));
  const blob=new Blob(['<!DOCTYPE html>\n'+doc.outerHTML],{type:'text/html;charset=utf-8'}),url=URL.createObjectURL(blob),a=document.createElement('a');a.href=url;a.download='mathematix-escape-room-6-grup.html';a.click();setTimeout(()=>URL.revokeObjectURL(url),1500);status('Pobrano sześć zapisanych konfiguracji. '+(drafts.size?'Szkice pozostałych grup nie są w pliku.':''));
 });
 window.addEventListener('beforeunload',e=>{if(drafts.size||(current?.isAdmin&&$('newPin').value!==current.pin)){e.preventDefault();e.returnValue=''}});
 if(!local)sb.auth.onAuthStateChange(event=>{if(event==='SIGNED_OUT')lock()});
 (async()=>{try{if(!local){const {data:{session}}=await sb.auth.getSession();if(session){await load();return}}lock()}catch{lock();status('Podaj PIN nauczyciela lub zaloguj administratora.')}})();
})();
