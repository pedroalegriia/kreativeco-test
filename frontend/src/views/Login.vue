<template>
    <div class="container">
        <h2>Iniciar Sesión</h2>
        <form @submit.prevent="loginUser">
            <div class="form-group">
                <label for="email">Correo</label>
                <input v-model="email" type="email" id="email" required />
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input v-model="password" type="password" id="password" required />
            </div>
            <button type="submit">Iniciar Sesión</button>
            <p v-if="error">{{ error }}</p>
        </form>
        <p>¿No tienes una cuenta? <router-link to="/Register">Regístrate aquí</router-link></p>

    </div>
</template>

<script>
import axios from '../axios';

export default {
    data() {
        return {
            email: '',
            password: '',
            error: null,
        };
    },
    methods: {
        async loginUser() {
            this.error = null;
            try {
                const response = await axios.post('/login', {
                    email: this.email,
                    password: this.password,
                });

                const token = response.data.data.token;
                console.log(token);
                if (token) {
                    localStorage.setItem('token', token); 
                    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`; 
                    this.$router.push({ name: 'Publications' });
                } else {
                    this.error = 'Token no recibido en la respuesta';
                }
            } catch (error) {
                this.error = 'Error al iniciar sesión'; 
                console.error('Error en el inicio de sesión:', error);
            }
        },
    },
};
</script>

<style scoped>
.container {
    max-width: 400px;
    margin: auto;
    padding: 20px;
}

.form-group {
    margin-bottom: 15px;
}
</style>