@extends('layouts.guest')

@section('title', 'Create Account')
@section('page-id', 'sign-up')

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
          <p class="fp-eyebrow">Create Account</p>
          <h1>Tell Us About Yourself</h1>
          <p class="fp-lead">Enter your details to proceed further</p>

          <div id="errorAlert" class="fp-alert err" role="alert"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg><span class="msg-text"></span></div>
          <div id="successAlert" class="fp-alert ok" role="status"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg><span class="msg-text"></span></div>

          <form id="signupForm" class="fp-form">
            <div class="fp-form-scroll">
              <div class="fp-field">
                <label for="email">Email address</label>
                <div class="fp-input">
                  <span class="fp-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m4 7 8 6 8-6"/></svg></span>
                  <input id="email" type="email" placeholder="Email Address" autocomplete="username" required>
                </div>
              </div>

              <div class="fp-field-row">
                <div class="fp-field">
                  <label for="firstName">First name</label>
                  <div class="fp-input">
                    <span class="fp-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 3.6-7 8-7s8 3 8 7"/></svg></span>
                    <input id="firstName" type="text" placeholder="First Name" autocomplete="given-name" required>
                  </div>
                </div>
                <div class="fp-field">
                  <label for="lastName">Last name</label>
                  <div class="fp-input">
                    <span class="fp-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 3.6-7 8-7s8 3 8 7"/></svg></span>
                    <input id="lastName" type="text" placeholder="Last Name" autocomplete="family-name" required>
                  </div>
                </div>
              </div>

              <div id="branchesContainer" class="fp-branches">
                <div class="fp-field">
                  <label for="branch1">Branch name</label>
                  <div class="fp-input">
                    <span class="fp-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"><path d="M12 21s7-6.2 7-11.5A7 7 0 0 0 5 9.5C5 14.8 12 21 12 21Z"/><circle cx="12" cy="9.5" r="2.3"/></svg></span>
                    <input id="branch1" type="text" class="branch-name-input" placeholder="Branch Name" required>
                  </div>
                </div>
              </div>
              <button type="button" id="addBranchBtn" class="fp-add-branch"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>Add another branch</button>

              <div class="fp-field">
                <label for="password">Password</label>
                <div class="fp-input">
                  <span class="fp-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><rect x="5" y="10" width="14" height="11" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/><path d="M12 14.5v2.5"/></svg></span>
                  <input id="password" type="password" placeholder="Create a password" autocomplete="new-password" required>
                  <button type="button" class="fp-eye" data-target="password" aria-label="Show password" aria-pressed="false">
                    <svg class="icon-eye" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" style="display:none"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8Z"/><circle cx="12" cy="12" r="3"/></svg>
                    <svg class="icon-eye-off" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a20.3 20.3 0 0 1 4.22-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a20.3 20.3 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                  </button>
                </div>
              </div>

              <div class="fp-field">
                <label for="confirmPassword">Confirm password</label>
                <div class="fp-input">
                  <span class="fp-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><rect x="5" y="10" width="14" height="11" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/><path d="M12 14.5v2.5"/></svg></span>
                  <input id="confirmPassword" type="password" placeholder="Re-enter your password" autocomplete="new-password" required>
                  <button type="button" class="fp-eye" data-target="confirmPassword" aria-label="Show password" aria-pressed="false">
                    <svg class="icon-eye" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" style="display:none"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8Z"/><circle cx="12" cy="12" r="3"/></svg>
                    <svg class="icon-eye-off" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a20.3 20.3 0 0 1 4.22-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a20.3 20.3 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                  </button>
                </div>
              </div>
            </div>

            <label class="fp-remember"><input type="checkbox" checked> Keep this station signed in</label>

            <button class="fp-submit" type="submit" id="signupSubmitBtn">Create Account <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
          </form>

          <p class="fp-switch">Already have an account? <a href="/login">Sign in</a></p>
        </div>
      </div>
    </section>
  </div>
  <div class="fp-credit">Designed by <a target="_blank" rel="noopener" href="https://infoasis.in/"><b>ATTechInfoasis</b></a></div>
</main>
@endsection

@section('scripts')
<script>
  function wirePasswordToggle(toggleBtn) {
    const input = document.getElementById(toggleBtn.dataset.target);
    toggleBtn.addEventListener('click', () => {
      const showing = input.type === 'text';
      input.type = showing ? 'password' : 'text';
      toggleBtn.querySelector('.icon-eye').style.display = showing ? 'none' : '';
      toggleBtn.querySelector('.icon-eye-off').style.display = showing ? '' : 'none';
      toggleBtn.setAttribute('aria-pressed', String(!showing));
      toggleBtn.setAttribute('aria-label', showing ? 'Show password' : 'Hide password');
    });
  }
  document.querySelectorAll('.fp-eye[data-target]').forEach(wirePasswordToggle);

  // dynamic branches input creation
  const addBranchBtn = document.getElementById('addBranchBtn');
  const branchesContainer = document.getElementById('branchesContainer');

  if (addBranchBtn && branchesContainer) {
    addBranchBtn.addEventListener('click', () => {
      const div = document.createElement('div');
      div.className = 'fp-field';
      div.innerHTML = `
        <label>Branch name</label>
        <div class="fp-input">
          <span class="fp-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"><path d="M12 21s7-6.2 7-11.5A7 7 0 0 0 5 9.5C5 14.8 12 21 12 21Z"/><circle cx="12" cy="9.5" r="2.3"/></svg></span>
          <input type="text" class="branch-name-input" placeholder="Branch Name" required>
          <button type="button" class="fp-remove" title="Remove branch" aria-label="Remove branch"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 7h16M10 11v6M14 11v6M6 7l1 13a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2l1-13M9 7V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3"/></svg></button>
        </div>
      `;

      div.querySelector('.fp-remove').addEventListener('click', () => {
        div.remove();
      });

      branchesContainer.appendChild(div);
      div.querySelector('input').focus();
    });
  }

  // signup API integration
  const signupForm = document.getElementById('signupForm');
  const errorAlert = document.getElementById('errorAlert');
  const successAlert = document.getElementById('successAlert');
  const submitBtn = document.getElementById('signupSubmitBtn');

  signupForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    errorAlert.style.display = 'none';
    successAlert.style.display = 'none';

    const email = document.getElementById('email').value;
    const first_name = document.getElementById('firstName').value;
    const last_name = document.getElementById('lastName').value;
    const password = document.getElementById('password').value;
    const password_confirmation = document.getElementById('confirmPassword').value;

    const branches = [];
    document.querySelectorAll('.branch-name-input').forEach((input) => {
      const val = input.value.trim();
      if (val) {
        branches.push(val);
      }
    });

    if (password !== password_confirmation) {
      errorAlert.querySelector('.msg-text').textContent = 'Passwords do not match.';
      errorAlert.style.display = 'flex';
      return;
    }

    submitBtn.disabled = true;
    const originalText = submitBtn.innerHTML;
    submitBtn.textContent = 'Creating Account...';

    try {
      const res = await fetch('/api/register', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: JSON.stringify({
          email,
          first_name,
          last_name,
          password,
          password_confirmation,
          branches
        })
      });

      const data = await res.json();

      if (res.ok) {
        successAlert.querySelector('.msg-text').textContent = 'Account created successfully! Redirecting to dashboard…';
        successAlert.style.display = 'flex';
        setTimeout(() => {
          window.location.href = '/dashboard';
        }, 1000);
      } else {
        errorAlert.querySelector('.msg-text').textContent = data.message || 'Registration failed. Please check the details and try again.';
        errorAlert.style.display = 'flex';
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
      }
    } catch (err) {
      errorAlert.querySelector('.msg-text').textContent = 'A connection error occurred. Please try again.';
      errorAlert.style.display = 'flex';
      submitBtn.disabled = false;
      submitBtn.innerHTML = originalText;
    }
  });
</script>
@endsection
