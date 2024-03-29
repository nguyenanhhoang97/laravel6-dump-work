function page (path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

function module (path) {
  return () => import(/* webpackChunkName: '' */ `~/modules/${path}`).then(m => m.default || m)
}

export default [
  { path: '/', redirect: { name: 'dashboard' } },

  { path: '/login', name: 'login', component: page('auth/login.vue') },
  { path: '/register', name: 'register', component: page('auth/register.vue') },
  { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },

  { path: '/home', name: 'home', component: page('home.vue') },
  { path: '/dashboard', name: 'dashboard', component: module('dashboard/index.vue') },
  { path: '/users', name: 'users', component: module('users/index.vue') },
  { path: '/projects', name: 'projects', component: module('projects/index.vue') },
  { path: '/roles', name: 'roles', component: module('roles/index.vue') },
  { path: '/profile', name: 'profile', component: module('session/profile.vue') },
  { path: '/settings',
    component: page('settings/index.vue'),
    children: [
      { path: '', redirect: { name: 'settings.profile' } },
      { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
      { path: 'password', name: 'settings.password', component: page('settings/password.vue') }
    ] },

  { path: '*', name: '*', component: page('errors/404.vue') }
]
