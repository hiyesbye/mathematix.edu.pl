(async () => {
    const navbar = document.getElementById('navbar');
    if (navbar && !navbar.querySelector('a[href="escape-room.html"]')) {
        const li = document.createElement('li');
        const a = document.createElement('a');
        a.href = 'escape-room.html'; a.textContent = 'Escape room';
        li.append(a);
        const matapki = navbar.querySelector('a[href="matapki.html"]')?.closest('li');
        if (matapki) matapki.after(li); else navbar.append(li);
    }
    if (typeof sb === 'undefined') return;
    const { data: { session } } = await sb.auth.getSession();

    const loginLi  = document.querySelector('#navbar a[href="login.html"]')?.closest('li');
    const signupA  = document.querySelector('#navbar a[href="signup.html"]');

    if (!session) return;

    const login = session.user.email.split('@')[0];

    if (loginLi) {
        loginLi.className = 'dropdown';
        loginLi.innerHTML = `
            <a href="profil.html" style="color:rgb(12,200,200);" class="dropbtn">Mój profil [${login}]</a>
            <div class="dropdown-content">
                <a href="#" id="navWyloguj" style="color:rgb(220,60,60);">Wyloguj się</a>
            </div>`;
        document.getElementById('navWyloguj').addEventListener('click', async (e) => {
            e.preventDefault();
            await sb.auth.signOut();
            window.location.reload();
        });
    }

    const { data: adminRow } = await sb.from('admins').select('id').eq('id', session.user.id).single();
    if (adminRow && loginLi) {
        const a = document.createElement('a');
        a.href = 'escape-room-admin.html'; a.textContent = 'Escape room — ustawienia';
        loginLi.querySelector('.dropdown-content')?.prepend(a);
    }
    if (adminRow && signupA) signupA.style.display = 'inline-block';
})();

