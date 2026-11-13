@extends('layouts.guest')

@section('title', 'Welcome Back')
@section('page-id', 'login')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&family=Montserrat:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/auth.css') }}?v={{ filemtime(public_path('css/auth.css')) }}">
@endsection

@section('content')
<main class="fp-page">
  <div class="fp-frame">
    <div class="fp-scene" aria-hidden="true"></div>

    <aside class="fp-visual" aria-label="Forward Prime Solutions">
      <a href="/dashboard" class="fp-brand">
        <img src="{{ asset('images/forward-logo.png') }}" alt="Forward Prime Solutions logo">
        <div><strong>Forward <em>Prime</em> Solutions Pvt. Ltd.</strong><span>Car Wash &amp; Detailing Management Platform</span></div>
      </a>

      <div class="fp-hero">
        <h2>Smart Car Wash<br><span class="red">Management</span><br><span class="sm">for a Cleaner Tomorrow</span></h2>
        <p>Manage your services, customers, and business in one powerful platform.</p>
      </div>

      <ul class="fp-features">
        <li><span class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 17h14v-4l-2-5H7l-2 5v4Z"/><path d="M3 13h18"/><circle cx="7.5" cy="17" r="1.6"/><circle cx="16.5" cy="17" r="1.6"/></svg></span>Service<br>Management</li>
        <li><span class="ic"><svg viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="7.5" r="3.2"/><circle cx="5.5" cy="9" r="2.4"/><circle cx="18.5" cy="9" r="2.4"/><path d="M6.5 19.5c0-3.3 2.5-5.6 5.5-5.6s5.5 2.3 5.5 5.6Z"/><path d="M1.5 19c0-2.6 1.7-4.4 4-4.4.7 0 1.3.1 1.9.4A7 7 0 0 0 5.2 19Z"/><path d="M22.5 19c0-2.6-1.7-4.4-4-4.4-.7 0-1.3.1-1.9.4a7 7 0 0 1 2.2 4Z"/></svg></span>Customer<br>Tracking</li>
        <li><span class="ic"><svg viewBox="0 0 24 24" fill="currentColor"><rect x="3" y="13" width="4" height="8" rx="1"/><rect x="10" y="9" width="4" height="12" rx="1"/><rect x="17" y="5" width="4" height="16" rx="1"/><path d="M3 9.5 9 5l4 3 7-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>Reports &amp;<br>Analytics</li>
        <li><span class="ic"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M10.3 2h3.4l.5 2.6a8 8 0 0 1 2 1.1l2.5-.9 1.7 2.9-2 1.7a8 8 0 0 1 0 2.3l2 1.7-1.7 2.9-2.5-.9a8 8 0 0 1-2 1.1l-.5 2.6h-3.4l-.5-2.6a8 8 0 0 1-2-1.1l-2.5.9-1.7-2.9 2-1.7a8 8 0 0 1 0-2.3l-2-1.7 1.7-2.9 2.5.9a8 8 0 0 1 2-1.1ZM12 8.6a3.4 3.4 0 1 0 0 6.8 3.4 3.4 0 0 0 0-6.8Z"/></svg></span>Business<br>Control</li>
      </ul>

      <div class="fp-spacer"></div>

      <div class="fp-badge">
        <svg viewBox="0 0 24 24"><path d="M12 2 4 5v6c0 5 3.4 9.4 8 11 4.6-1.6 8-6 8-11V5Z" fill="#e30d17"/><path d="m8.5 12 2.4 2.4 4.6-4.8" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <div><strong>Secure &amp; Reliable Platform</strong><span>Built for Modern Car Wash Businesses</span></div>
      </div>
    </aside>

    <section class="fp-form-side">
      <div class="fp-card">
        <div class="fp-card-inner">
          <p class="fp-eyebrow">Welcome Back!</p>
          <h1>Login <span class="or">or</span> Sign In</h1>
          <p class="fp-lead">Please enter your credentials to access your dashboard.</p>

          <div id="errorAlert" class="fp-alert err" role="alert"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg><span class="msg-text"></span></div>
          <div id="successAlert" class="fp-alert ok" role="status"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg><span class="msg-text"></span></div>

          <form id="loginForm" class="fp-form">
            <div class="fp-field">
              <label for="user">Email or Username</label>
              <div class="fp-input">
                <span class="fp-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 3.6-7 8-7s8 3 8 7"/></svg></span>
                <input id="user" type="email" placeholder="Email or Username" autocomplete="username" required>
              </div>
            </div>

            <div class="fp-field">
              <label for="pass">Password</label>
              <div class="fp-input">
                <span class="fp-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><rect x="5" y="10" width="14" height="11" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/><path d="M12 14.5v2.5"/></svg></span>
                <input id="pass" type="password" placeholder="Password" autocomplete="current-password" required>
                <button type="button" class="fp-eye" id="passToggle" aria-label="Show password" aria-pressed="false">
                  <svg class="icon-eye" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" style="display:none"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8Z"/><circle cx="12" cy="12" r="3"/></svg>
                  <svg class="icon-eye-off" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a20.3 20.3 0 0 1 4.22-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a20.3 20.3 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                </button>
              </div>
            </div>

            <div class="fp-row">
              <label class="fp-remember"><input type="checkbox" id="remember"> Remember me</label>
              <a class="fp-forgot" href="#">Forgot Password?</a>
            </div>

            <button class="fp-submit" type="submit" id="loginSubmitBtn">Login <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
          </form>
        </div>
      </div>
    </section>
  </div>
  <div class="fp-credit">Designed by <a target="_blank" rel="noopener" href="https://infoasis.in/"><b>ATTechInfoasis</b></a></div>
</main>
@endsection

@section('scripts')
<script>
  const passInput = document.getElementById('pass'), passToggle = document.getElementById('passToggle');
  passToggle.addEventListener('click', () => {
    const showing = passInput.type === 'text';
    passInput.type = showing ? 'password' : 'text';
    passToggle.querySelector('.icon-eye').style.display = showing ? 'none' : '';
    passToggle.querySelector('.icon-eye-off').style.display = showing ? '' : 'none';
    passToggle.setAttribute('aria-pressed', String(!showing));
    passToggle.setAttribute('aria-label', showing ? 'Show password' : 'Hide password');
  });

  const loginSubmitBtn = document.getElementById('loginSubmitBtn'), urlParams = new URLSearchParams(window.location.search);
  const loginForm = document.getElementById('loginForm'), errorAlert = document.getElementById('errorAlert'), successAlert = document.getElementById('successAlert');

  loginForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    errorAlert.style.display = successAlert.style.display = 'none';
    loginSubmitBtn.disabled = true;
    const originalText = loginSubmitBtn.innerHTML;
    loginSubmitBtn.textContent = 'Logging in...';
    try {
      const res = await fetch('/api/login', {
        method:'POST',
        headers:{'Content-Type':'application/json','Accept':'application/json'},
        body:JSON.stringify({
          email:document.getElementById('user').value,
          password:passInput.value,
          remember:document.getElementById('remember').checked
        })
      });
      const data = await res.json();
      if (res.ok) {
        localStorage.setItem('sw_user_role', 'admin');
        successAlert.querySelector('.msg-text').textContent = 'Success! Redirecting…';
        successAlert.style.display = 'flex';
        setTimeout(() => window.location.href = urlParams.get('redirect') || '/dashboard', 700);
      } else {
        errorAlert.querySelector('.msg-text').textContent = data.message || 'Login failed. Please check your credentials.';
        errorAlert.style.display = 'flex';
        loginSubmitBtn.disabled = false;
        loginSubmitBtn.innerHTML = originalText;
      }
    } catch (err) {
      errorAlert.querySelector('.msg-text').textContent = 'A connection error occurred. Please try again.';
      errorAlert.style.display = 'flex';
      loginSubmitBtn.disabled = false;
      loginSubmitBtn.innerHTML = originalText;
    }
  });
</script>
@endsection
