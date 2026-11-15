(() => {
 'use strict';
 const $ = id => document.getElementById(id);
 const names = {numeric:'Kod cyfrowy',letters:'Kod literowy',mixed:'Kod mieszany'};
 let group=null,mode=null,step=1,value='',visible=false,opened=false,busy=false;
 const normalize=v=>v.normalize('NFC').toLocaleUpperCase('pl-PL');
 function allowed(c){return (mode==='numeric'?/^\d$/:mode==='letters'?/^[A-ZĄĆĘŁŃÓŚŹŻ]$/:/^[A-ZĄĆĘŁŃÓŚŹŻ0-9]$/).test(c)}
 function status(msg,error=false){$('feedback').textContent=msg;$('feedback').className='feedback'+(error?' error':'')}
 function draw(){const display=$('display');display.textContent=value?(visible?value:'•'.repeat(value.length)):'TWÓJ KOD';display.classList.toggle('empty',!value);display.setAttribute('aria-label',value?'Wpisano '+value.length+' znaków':'Wpisany kod, puste');$('counter').textContent=value.length+' / 32 znaków';$('demo').textContent=window.EscapeRoomLocal?'◇ Wersja offline · Mathematix':'◇ Konfiguracja wspólna · Mathematix'}
 function setStep(next,focus=true){step=next;['groupStep','formatStep','codeStep'].forEach((id,i)=>$(id).hidden=i+1!==next);document.querySelectorAll('[data-step]').forEach(li=>{if(Number(li.dataset.step)===next)li.setAttribute('aria-current','step');else li.removeAttribute('aria-current')});$('sceneGroup').textContent=group?'GRUPA '+group+' / PANEL DOSTĘPU':'PANEL DOSTĘPU';if(focus)$(next===1?'groupHeading':next===2?'formatHeading':'display').focus();}
 function reset(){opened=false;value='';visible=false;$('reveal').setAttribute('aria-pressed','false');$('reveal').setAttribute('aria-label','Pokaż wpisane znaki');$('door').classList.remove('open-glow');$('sceneTitle').textContent='Brama zamknięta';$('sceneText').textContent='Dostęp do kolejnego etapu wymaga poprawnego kodu. Wybierz swoją grupę i format kodu w panelu obok.';draw();status('Użyj klawiatury poniżej lub klawiatury komputera.')}
 function start(){group=null;mode=null;reset();setStep(1)}
 function pulse(c){const btn=[...$('keys').querySelectorAll('button')].find(b=>b.dataset.char===c);if(btn){btn.classList.remove('pressed');void btn.offsetWidth;btn.classList.add('pressed');setTimeout(()=>btn.classList.remove('pressed'),130)}}
 function enter(c){if(step!==3||opened||busy)return;const n=normalize(c);if(!allowed(n))return;if(value.length>=32){status('Kod może mieć maksymalnie 32 znaki.',true);return}value+=n;pulse(n);draw();status('Gdy kod będzie gotowy, otwórz bramę.')}
 function erase(all=false){if(busy||step!==3)return;value=all?'':value.slice(0,-1);draw();status('Użyj klawiatury poniżej lub klawiatury komputera.')}
 function keyboard(){const rows=mode==='numeric'?['123','456','789','0']:mode==='letters'?['QWERTYUIOP','ASDFGHJKL','ZXCVBNM','ĄĆĘŁŃÓŚŹŻ']:['1234567890','QWERTYUIOP','ASDFGHJKL','ZXCVBNM','ĄĆĘŁŃÓŚŹŻ'];$('keys').replaceChildren();$('keys').className='keys'+(mode==='numeric'?' numeric':'');for(const chars of rows){const row=document.createElement('div');row.className='row'+(chars.includes('Ą')?' polish':'');for(const c of chars){const b=document.createElement('button');b.className='key';b.textContent=c;b.dataset.char=c;b.setAttribute('aria-label',c);row.append(b)}$('keys').append(row)}}
 async function submit(){
  if(step!==3||group===null||mode===null||opened||busy)return;
  if(!value){status('Najpierw wpisz kod.',true);return}
  busy=true;$('submit').disabled=true;$('submit').setAttribute('aria-busy','true');status('Sprawdzanie kodu…');
  const controller=new AbortController(),timer=setTimeout(()=>controller.abort(),10000);
  try{
   let data;
   if(window.EscapeRoomLocal)data=window.EscapeRoomLocal.verify(group,mode,value);
   else{if(typeof sb==='undefined')throw new Error('Brak połączenia');const res=await sb.rpc('escape_room_group_verify',{p_group:group,p_mode:mode,p_code:value}).abortSignal(controller.signal);if(res.error||!res.data)throw res.error||new Error('Brak odpowiedzi');data=res.data;}
   if(data.correct){opened=true;$('door').classList.add('open-glow');$('sceneTitle').textContent='Dostęp przyznany';$('sceneText').textContent='Grupa '+group+' podała poprawny kod. Możecie przejść do kolejnego etapu.';$('successMessage').textContent=data.message;status('Kod poprawny!');$('feedback').className='feedback ok';$('successDialog').showModal()}
   else{status('Nieprawidłowy kod dla grupy '+group+'. Spróbuj ponownie.',true);$('displayWrap').classList.remove('shake');void $('displayWrap').offsetWidth;$('displayWrap').classList.add('shake');value='';draw()}
  }catch{status('Nie udało się sprawdzić kodu. Sprawdź internet i spróbuj ponownie.',true)}
  finally{clearTimeout(timer);busy=false;$('submit').disabled=false;$('submit').removeAttribute('aria-busy')}
 }
 document.querySelectorAll('[data-group]').forEach(b=>b.addEventListener('click',()=>{if(busy)return;group=Number(b.dataset.group);mode=null;reset();$('formatGroup').textContent='Grupa '+group;setStep(2)}));
 document.querySelectorAll('[data-mode]').forEach(b=>b.addEventListener('click',()=>{if(busy||group===null)return;mode=b.dataset.mode;reset();$('codeContext').textContent='Grupa '+group+' · '+names[mode];keyboard();setStep(3)}));
 $('changeGroupFormat').onclick=$('changeGroupCode').onclick=()=>{if(!busy)start()};
 $('changeFormat').onclick=()=>{if(!busy){mode=null;reset();setStep(2)}};
 $('keys').addEventListener('click',e=>{const key=e.target.closest('button[data-char]');if(key)enter(key.dataset.char)});
 $('clear').onclick=()=>erase(true);$('backspace').onclick=()=>erase();$('submit').onclick=submit;
 $('reveal').onclick=()=>{visible=!visible;$('reveal').setAttribute('aria-pressed',String(visible));$('reveal').setAttribute('aria-label',visible?'Ukryj wpisane znaki':'Pokaż wpisane znaki');draw()};
 document.addEventListener('keydown',e=>{if(step!==3||document.querySelector('dialog[open]')||e.ctrlKey||e.metaKey||e.altKey||e.isComposing)return;if(e.key==='Backspace'){e.preventDefault();erase()}else if(e.key==='Enter'&&(!e.target.closest('button,a')||e.target.closest('.key'))){e.preventDefault();submit()}else if(e.key.length===1&&allowed(normalize(e.key))){e.preventDefault();enter(e.key)}});
 $('successDialog').addEventListener('close',start);$('nextTeam').onclick=()=>{$('successDialog').close()};
 $('fullscreen').onclick=async()=>{try{if(document.fullscreenElement)await document.exitFullscreen();else await document.documentElement.requestFullscreen()}catch{status('Ta przeglądarka nie obsługuje pełnego ekranu.')}};
 document.addEventListener('fullscreenchange',()=>document.body.classList.toggle('fullscreen',!!document.fullscreenElement));
 reset();setStep(1,false);
})();
