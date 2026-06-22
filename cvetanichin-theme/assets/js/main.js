/**
 * Cvetanichin Theme — Main JavaScript
 *
 * Handles:
 *  - Sticky nav shadow on scroll
 *  - Scroll-reveal animations (IntersectionObserver)
 *  - Mobile menu toggle
 *  - Smooth anchor scrolling
 */

( function() {
  'use strict';

  // ── Nav scroll shadow ──────────────────────────────────────────────────
  const nav = document.getElementById( 'cv-nav' );
  if ( nav ) {
    const onScroll = () => {
      nav.classList.toggle( 'scrolled', window.scrollY > 20 );
    };
    window.addEventListener( 'scroll', onScroll, { passive: true } );
    onScroll();
  }

  // ── Scroll reveal ──────────────────────────────────────────────────────
  if ( 'IntersectionObserver' in window ) {
    const observer = new IntersectionObserver(
      ( entries ) => {
        entries.forEach( ( entry, i ) => {
          if ( entry.isIntersecting ) {
            const el    = entry.target;
            const delay = parseFloat( el.dataset.revealDelay || 0 );
            setTimeout( () => el.classList.add( 'revealed' ), delay * 1000 );
            observer.unobserve( el );
          }
        } );
      },
      { threshold: 0.12, rootMargin: '0px 0px -40px 0px' }
    );

    document.querySelectorAll( '.cv-reveal' ).forEach( ( el, i ) => {
      // Stagger siblings inside the same parent
      if ( ! el.dataset.revealDelay ) {
        const siblings = el.parentElement.querySelectorAll( '.cv-reveal' );
        let idx = 0;
        siblings.forEach( ( sib, j ) => { if ( sib === el ) idx = j; } );
        el.dataset.revealDelay = ( idx * 0.1 ).toFixed( 1 );
      }
      observer.observe( el );
    } );
  } else {
    // Fallback: show everything immediately
    document.querySelectorAll( '.cv-reveal' ).forEach( el => el.classList.add( 'revealed' ) );
  }

  // ── Mobile menu toggle ─────────────────────────────────────────────────
  const menuToggle = document.getElementById( 'cv-nav-toggle' );
  const primaryMenu = document.querySelector( '.cv-nav__menu' );

  if ( menuToggle && primaryMenu ) {
    menuToggle.addEventListener( 'click', () => {
      const isOpen = menuToggle.getAttribute( 'aria-expanded' ) === 'true';
      menuToggle.setAttribute( 'aria-expanded', isOpen ? 'false' : 'true' );
      primaryMenu.classList.toggle( 'cv-nav__menu--open', ! isOpen );
    } );

    // Close on outside click
    document.addEventListener( 'click', ( e ) => {
      if ( nav && ! nav.contains( e.target ) ) {
        menuToggle.setAttribute( 'aria-expanded', 'false' );
        primaryMenu.classList.remove( 'cv-nav__menu--open' );
      }
    } );
  }

  // Legacy toggle support
  const menuBtn = document.getElementById( 'cv-menu-toggle' );
  const mobileMenu = document.getElementById( 'cv-mobile-menu' );
  if ( menuBtn && mobileMenu ) {
    menuBtn.addEventListener( 'click', () => {
      const isOpen = mobileMenu.getAttribute( 'aria-hidden' ) === 'false';
      mobileMenu.setAttribute( 'aria-hidden', isOpen ? 'true' : 'false' );
      menuBtn.setAttribute( 'aria-expanded', isOpen ? 'false' : 'true' );
      mobileMenu.style.display = isOpen ? 'none' : 'flex';
    } );
  }

  // ── Smooth anchor scrolling ────────────────────────────────────────────
  document.querySelectorAll( 'a[href^="#"]' ).forEach( anchor => {
    anchor.addEventListener( 'click', function ( e ) {
      const target = document.querySelector( this.getAttribute( 'href' ) );
      if ( ! target ) return;
      e.preventDefault();
      const offset = nav ? nav.offsetHeight + 16 : 80;
      const top    = target.getBoundingClientRect().top + window.scrollY - offset;
      window.scrollTo( { top, behavior: 'smooth' } );
    } );
  } );

  // ── Back-to-top ───────────────────────────────────────────────────────
  const btt = document.getElementById( 'cv-back-to-top' );
  if ( btt ) {
    window.addEventListener( 'scroll', () => {
      btt.style.opacity = window.scrollY > 600 ? '1' : '0';
      btt.style.pointerEvents = window.scrollY > 600 ? 'auto' : 'none';
    }, { passive: true } );

    btt.addEventListener( 'click', () => window.scrollTo( { top: 0, behavior: 'smooth' } ) );
  }

} )();
