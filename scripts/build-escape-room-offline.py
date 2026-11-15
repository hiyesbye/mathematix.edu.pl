from pathlib import Path
import re,json
root=Path(__file__).resolve().parents[1]
main=(root/'escape-room.html').read_text();teacher=(root/'escape-room-admin.html').read_text()
# The editor shares the tested teacher-panel implementation with the online page.
teacher_css=teacher.split('<style>')[1].split('</style>')[0]
# Scope editor styles to the dialog, leaving the gate's layout unchanged.
def scoped(css):
 out=''; pos=0
 while pos<len(css):
  opening=css.find('{',pos)
  if opening<0:break
  selector=css[pos:opening].strip(); depth=1; end=opening+1
  while end<len(css) and depth:
   if css[end]=='{':depth+=1
   elif css[end]=='}':depth-=1
   end+=1
  inner=css[opening+1:end-1]
  if selector.startswith('@media'):out+=selector+'{'+scoped(inner)+'}'
  elif selector=='body':pass
  else:
   sels=[('.offline-settings' if part.strip()==':root' else '.offline-settings '+part.strip()) for part in selector.split(',')]
   out+=','.join(sels)+'{'+inner+'}'
  pos=end
 return out
css='\n'+scoped(teacher_css)+'\n' 
body=teacher.split('<main>')[1].split('</main>')[0]
body=body.replace('<h1>Panel nauczyciela</h1>','<h2>Panel nauczyciela · offline</h2>').replace('Ustaw osobne kody bramy dla grup 1–6. Zapisana konfiguracja działa na wszystkich komputerach i tabletach połączonych z internetem.','Ustaw osobne kody dla grup 1–6 w tym pliku. Zmiany zapisują się lokalnie w tej przeglądarce.').replace('<a href="login.html">Zaloguj administratora →</a>','').replace('Zaloguj się na konto administratora Mathematix lub podaj PIN panelu nauczyciela.','Podaj PIN panelu nauczyciela zapisany w tym pliku.').replace('Zaloguj administratora lub podaj PIN.','Podaj PIN panelu nauczyciela.').replace('Nowe kody działają na wszystkich urządzeniach online.','Zmiany działają lokalnie.').replace('na wszystkich urządzeniach online','w tym pliku').replace('Wczyta dane z serwera','Wczyta dane z tego pliku')
body=body.replace('PIN jest zawsze widoczny w panelu administratora.','PIN jest widoczny tutaj po otwarciu ustawień.')
main=main.replace('</style>',css+'</style>')
main=main.replace('<a class="tool" href="index.html" style="text-decoration:none">← Mathematix</a>','<a class="tool" href="https://mathematix.edu.pl/" style="text-decoration:none">← Mathematix</a>')
main=main.replace('<a class="tool" href="escape-room-admin.html" style="text-decoration:none">⚙ Panel nauczyciela</a>','<button class="tool" id="offlineSettingsOpen">⚙ Panel nauczyciela</button>')
start=main.index('<script src="https://cdn.jsdelivr.net')
config=None
main=main[:start]+'<dialog id="offlineSettings" class="offline-settings"><button class="close" id="offlineSettingsClose" aria-label="Zamknij ustawienia">×</button>'+body+'</dialog>'
main+='<script id="boot-config" type="application/json">'+json.dumps(config,ensure_ascii=False)+'</script>'
for filename in ['escape-room-local.js','escape-room.js','escape-room-admin.js']:
 main+='<script>\n'+(root/filename).read_text()+'\n</script>'
main+='''<script>document.getElementById('offlineSettingsOpen').onclick=()=>document.getElementById('offlineSettings').showModal();document.getElementById('offlineSettingsClose').onclick=()=>document.getElementById('offlineSettings').close();document.getElementById('offlineSettings').addEventListener('close',()=>document.getElementById('lock').click());</script></body></html>'''
main=main.replace('<div class="layout">','<p id="offlineTemplateNotice" hidden style="padding:15px;border:1px solid #d8b77c;color:#e5ca90;">To szablon. Pobierz gotowy plik offline z panelu nauczyciela na Mathematix.</p><div class="layout">')
(root/'escape-room-offline.html').write_text(main)
