<template>
    <div class="container">
        <h2>Registro de Usuario</h2>
        <form @submit.prevent="registerUser">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input v-model="nombre" type="text" id="nombre" required />
                <p v-if="errors.nombre">{{ errors.nombre }}</p>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input v-model="apellido" type="text" id="apellido" required />
                <p v-if="errors.apellido">{{ errors.apellido }}</p>
            </div>
            <div class="form-group">
                <label for="email">Correo</label>
                <input v-model="email" type="email" id="email" required />
                <p v-if="errors.email">{{ errors.email }}</p>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input v-model="password" type="password" id="password" required minlength="6" />
                <p v-if="errors.password">{{ errors.password }}</p>
            </div>
            <div class="form-group">
                <label for="rol">Rol</label>
                <select v-model="rol" id="rol" required>
                    <option value="1">Admin</option>
                    <option value="2">Usuario</option>
                </select>
            </div>
            <button type="submit">Registrar</button>
            <p v-if="error">{{ error }}</p>
            <p v-if="successMessage">{{ successMessage }}</p>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            nombre: '',
            apellido: '',
            email: '',
            password: '',
            rol: '1',
            errors: {},
            error: null,
            successMessage: null, 
        };
    },
    methods: {
        async registerUser() {
            this.errors = {};
            this.error = null;
            this.successMessage = null;
            try {
                const response = await axios.post('http://localhost:8000/usuarios', {
                    nombre: this.nombre,
                    apellido: this.apellido,
                    email: this.email,
                    password: this.password,
                    rol_id: this.rol,
                });
                console.log(response.data);

                this.nombre = '';
                this.apellido = '';
                this.email = '';
                this.password = '';
                this.rol = '1';

                this.successMessage = 'Usuario registrado exitosamente!';
            } catch (error) {
                if (error.response && error.response.data.errors) {
                    this.errors = error.response.data.errors;
                } else {
                    this.error = 'Error al registrar usuario';
                }
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