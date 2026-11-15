/* Browser-local adapter for the single-file offline edition. No network requests. */
(() => {
 'use strict';
 const boot=document.getElementById('boot-config');if(!boot)return;
 function valid(c){return c&&/^\d{4,12}$/.test(c.pin)&&Array.isArray(c.groups)&&c.groups.length===6&&c.groups.every((g,i)=>g.group===i+1&&/^\d{1,32}$/.test(g.numeric)&&/^[A-ZĄĆĘŁŃÓŚŹŻ]{1,32}$/.test(g.letters)&&/^[A-ZĄĆĘŁŃÓŚŹŻ0-9]{1,32}$/.test(g.mixed)&&typeof g.message==='string'&&g.message.length>0&&g.message.length<=160&&Number.isInteger(g.revision))}
 const embedded=JSON.parse(boot.textContent);if(!valid(embedded)){
  const unavailable=()=>{throw new Error('Pobierz skonfigurowany plik offline z panelu nauczyciela.')};
  window.EscapeRoomLocal={read:unavailable,save:unavailable,verify:unavailable};
  const notice=document.getElementById('offlineTemplateNotice');if(notice)notice.hidden=false;
  document.querySelectorAll('[data-group],#offlineSettingsOpen').forEach(b=>b.disabled=true);
  return;
 }
 const key='mathematix-escape-room-groups:'+JSON.stringify(embedded);let config=structuredClone(embedded);
 try{const saved=JSON.parse(localStorage.getItem(key));if(valid(saved))config=saved}catch{}
 function read(pin){if(pin!==config.pin)throw new Error('Nieprawidłowy PIN.');return {...structuredClone(config),isAdmin:true}}
 window.EscapeRoomLocal={
  read,
  verify(group,mode,value){const g=config.groups.find(g=>g.group===group);const correct=!!g&&['numeric','letters','mixed'].includes(mode)&&value.normalize('NFC').toLocaleUpperCase('pl-PL')===g[mode];return correct?{correct:true,message:g.message}:{correct:false}},
  save(a){read(a.p_pin);const next=structuredClone(config),g=next.groups.find(g=>g.group===a.p_group);if(!g||g.revision!==a.p_revision)throw new Error('Konfiguracja zmieniła się. Wczytaj ustawienia ponownie.');Object.assign(g,{numeric:a.p_numeric,letters:a.p_letters,mixed:a.p_mixed,message:a.p_message,revision:g.revision+1});if(a.p_new_pin!==null){next.pin=a.p_new_pin;next.pinRevision=(next.pinRevision||1)+1}if(!valid(next))throw new Error('Sprawdź format kodów i PIN-u.');config=next;try{localStorage.setItem(key,JSON.stringify(config))}catch{throw new Error('Konfiguracja działa w tej sesji, lecz przeglądarka nie zapisała jej. Pobierz nowy plik, aby ją zachować.')}return read(config.pin)}
 };
})();
