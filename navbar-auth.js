(async () => {
    if (typeof sb === 'undefined') return;
    const { data: { session } } = await sb.auth.getSession();

    const loginLi  = document.querySelector('#navbar a[href="login.html"]')?.closest('li');
    const signupA  = document.querySelector('#navbar a[href="signup.html"]');

    if (!session) return;

    const login = session.user.email.split('@')[0];

    if (loginLi) {
        loginLi.innerHTML = `<a href="profil.html" style="color:rgb(12,200,200);">Mój profil [${login}]</a>`;
        const wylogujLi = document.createElement('li');
        wylogujLi.innerHTML = `<a href="#" style="color:rgb(255,100,100);" id="navWyloguj">Wyloguj się</a>`;
        loginLi.after(wylogujLi);
        document.getElementById('navWyloguj').addEventListener('click', async (e) => {
            e.preventDefault();
            await sb.auth.signOut();
            window.location.reload();
        });
    }

    const { data: adminRow } = await sb.from('admins').select('id').eq('id', session.user.id).single();
    if (adminRow && signupA) signupA.style.display = 'inline-block';
})();
