/* ============
 * Routes File
 * ============
 *
 * The routes and redirects are defined in this file
 */

import loader from './utils/loader';

/**
 * The routes
 *
 * @type {object} The routes
 */
export default [
  {
    path: '/quiz',
    name: 'quiz.index',
    component: loader.page('quiz', 'index'),
  },

  {
    path: '/result',
    name: 'quiz.result',
    component: loader.page('quiz', 'result'),
  },

  {
    path: '/:uuid',
    name: 'quiz.index',
    component: loader.page('quiz', 'index'),
  },
  {
    path: '/*',
    name: 'quiz.index',
    component: loader.page('quiz', 'index'),
  },
];
