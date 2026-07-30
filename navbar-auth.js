(async () => {
    if (typeof sb === 'undefined') return;
    const { data: { session } } = await sb.auth.getSession();
    if (!session) return;

    const login = session.user.email.split('@')[0];

    const loginLi = document.querySelector('#navbar a[href="login.html"]')?.closest('li');
    const signupLi = document.querySelector('#navbar a[href="signup.html"]')?.closest('li');

    if (loginLi) {
        loginLi.innerHTML = `<a href="profil.html" style="color:rgb(12,200,200);">Zalogowano [${login}]</a>`;
    }
    if (signupLi) signupLi.remove();
})();
