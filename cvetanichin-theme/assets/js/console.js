/**
 * Vas Digital Console — Dashboard Interactivity
 * Enhances the embedded Creative Life Space dashboard.
 */

( function () {
  'use strict';

  // ── Role / mood selector ─────────────────────────────────────────────────
  document.querySelectorAll( '[data-role-select]' ).forEach( btn => {
    btn.addEventListener( 'click', () => {
      const role = btn.dataset.roleSelect;
      document.body.setAttribute( 'data-role', role );
      document.querySelectorAll( '[data-role-select]' ).forEach( b => b.classList.remove( 'active' ) );
      btn.classList.add( 'active' );
      try { localStorage.setItem( 'vc_role', role ); } catch (e) {}
    } );
  } );

  // Restore saved role
  try {
    const saved = localStorage.getItem( 'vc_role' );
    if ( saved ) {
      document.body.setAttribute( 'data-role', saved );
      const btn = document.querySelector( `[data-role-select="${ saved }"]` );
      if ( btn ) btn.classList.add( 'active' );
    }
  } catch (e) {}

  // ── Sidebar nav links ────────────────────────────────────────────────────
  document.querySelectorAll( '[data-section-link]' ).forEach( link => {
    link.addEventListener( 'click', ( e ) => {
      e.preventDefault();
      const target = document.getElementById( link.dataset.sectionLink );
      if ( target ) {
        target.scrollIntoView( { behavior: 'smooth', block: 'start' } );
        document.querySelectorAll( '[data-section-link]' ).forEach( l => l.classList.remove( 'active' ) );
        link.classList.add( 'active' );
      }
    } );
  } );

  // ── Module expand / collapse ─────────────────────────────────────────────
  document.querySelectorAll( '[data-module-toggle]' ).forEach( btn => {
    btn.addEventListener( 'click', () => {
      const module = btn.closest( '[data-module]' );
      if ( module ) module.classList.toggle( 'module--expanded' );
    } );
  } );

  // ── Task checklist ───────────────────────────────────────────────────────
  document.querySelectorAll( '.task-item input[type="checkbox"]' ).forEach( cb => {
    const key = 'vc_task_' + encodeURIComponent( cb.closest( '.task-item' )?.textContent?.trim()?.slice( 0, 40 ) );
    try { if ( localStorage.getItem( key ) === '1' ) cb.checked = true; } catch (e) {}
    cb.addEventListener( 'change', () => {
      try { localStorage.setItem( key, cb.checked ? '1' : '0' ); } catch (e) {}
      cb.closest( '.task-item' )?.classList.toggle( 'task-item--done', cb.checked );
    } );
  } );

  // ── Textarea autosave (journal / ritual inputs) ──────────────────────────
  document.querySelectorAll( '.ritual-input, textarea[data-autosave]' ).forEach( el => {
    const key = 'vc_input_' + ( el.dataset.autosave || el.placeholder?.slice( 0, 30 ) || Math.random() );
    try { el.value = localStorage.getItem( key ) || ''; } catch (e) {}
    el.addEventListener( 'input', () => {
      try { localStorage.setItem( key, el.value ); } catch (e) {}
    } );
  } );

  // ── Date / greeting ──────────────────────────────────────────────────────
  const dateEl = document.getElementById( 'vc-today' );
  if ( dateEl ) {
    const now = new Date();
    dateEl.textContent = now.toLocaleDateString( 'en-GB', {
      weekday: 'long', day: 'numeric', month: 'long', year: 'numeric'
    } );
  }

  const greetEl = document.getElementById( 'vc-greeting' );
  if ( greetEl ) {
    const h = new Date().getHours();
    greetEl.textContent = h < 12 ? 'Good morning' : h < 17 ? 'Good afternoon' : 'Good evening';
  }

} )();
