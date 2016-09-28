/* ============
 * Home Transition
 * ============ */
import { TimelineMax, Power4 } from 'gsap';

export default class HomeTransition {
  static enter(el, done) {
    const tl = new TimelineMax({
      onComplete: done,
    });

    tl.fromTo(el, 1, {
      autoAlpha: 0,
      x: window.innerWidth,
    }, {
      autoAlpha: 1,
      x: 0,
      ease: Power4.easeOut,
    });

    tl.staggerFromTo(el.querySelectorAll('.js-stagger'), 1, {
      autoAlpha: 0,
      x: -200,
      rotation: '.15rad',
    }, {
      autoAlpha: 1,
      x: 0,
      rotation: 0,
      ease: Power4.easeOut,
    }, 0.05, '-=0.25');
  }

  static leave(el, done) {
    const tl = new TimelineMax({
      onComplete: done,
    });

    tl.staggerFromTo(el.querySelectorAll('.js-stagger'), 1, {
      autoAlpha: 1,
      x: 0,
      rotation: 0,
    }, {
      autoAlpha: 0,
      x: 200,
      rotation: '-.15rad',
      ease: Power4.easeOut,
    }, 0.05);
  }
}
