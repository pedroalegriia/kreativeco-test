import { createRouter, createWebHistory } from 'vue-router';
import Register from '../views/Register.vue';
import Login from '../views/Login.vue';
import Publications from '../views/Publications.vue';
import PublicationForm from '../components/PublicactionForm.vue'; // Asegúrate de que esta ruta sea correcta

const routes = [
{
    path: '/',
    name: 'Login',
    component: Login,
  },
  {
    path: '/register',
    name: 'Register',
    component: Register,
  },
 
  {
    path: '/publications',
    name: 'Publications',
    component: Publications,
    meta: { requiresAuth: true }, // Requiere autenticación
  },
  {
    path: '/publications/create',
    name: 'CreatePublication',
    component: PublicationForm,
    meta: { requiresAuth: true }, // Requiere autenticación
  },
  {
    path: '/edit-publication/:id/:titulo/:descripcion',
    name: 'EditPublication',
    component: PublicationForm,
    meta: { requiresAuth: true }, // Requiere autenticación
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

// Guardia de navegación
router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('token');
  const isAuthenticated = !!token; // Verificar si hay un token

  if (to.matched.some(record => record.meta.requiresAuth) && !isAuthenticated) {
    next({ name: 'Login' });
  } else {
    next();
  }
});

export default router;