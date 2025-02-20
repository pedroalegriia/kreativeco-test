<template>
    <div class="container">
        <h2 v-if="isEdit">Editar Publicación</h2>
        <h2 v-else>Crear Publicación</h2>
        <form @submit.prevent="submitPublication">
            <div class="form-group">
                <label for="titulo">Título</label>
                <input v-model="titulo" type="text" id="titulo" required />
                <p v-if="errors.titulo">{{ errors.titulo }}</p>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea v-model="descripcion" id="descripcion" required></textarea>
                <p v-if="errors.descripcion">{{ errors.descripcion }}</p>
            </div>
            <button type="submit">{{ isEdit ? 'Actualizar' : 'Crear' }}</button>
            <p v-if="error">{{ error }}</p>
        </form>
    </div>
</template>

<script>
import axios from '../axios'; // Importa tu instancia de Axios

export default {
    data() {
        return {
            titulo: '',
            descripcion: '',
            errors: {},
            error: null,
            isEdit: false,
        };
    },
    created() {
        // Verifica si hay un id en los parámetros de la ruta
        if (this.$route.params.id) {
            console.log(this.titulo)
            this.isEdit = true; // Cambia a modo edición
            // Inicializa los valores de titulo y descripcion desde los parámetros
            this.titulo = this.$route.params.titulo; // Carga el título desde los parámetros
            this.descripcion = this.$route.params.descripcion; // Carga la descripción desde los parámetros
        }
    },
    methods: {
        async submitPublication() {
            this.errors = {};
            this.error = null;
            const url = this.isEdit ? `/publicaciones/${this.$route.params.id}` : '/publicaciones';
            const method = this.isEdit ? 'put' : 'post';

            try {
                await axios[method](url, {
                    titulo: this.titulo,
                    descripcion: this.descripcion,
                });
                this.$router.push({ name: 'Publications' }); // Redirigir después de guardar
            } catch (error) {
                if (error.response && error.response.data.errors) {
                    this.errors = error.response.data.errors; // Manejo de errores de validación
                } else {
                    this.error = 'Error al guardar publicación'; // Manejo de errores generales
                }
            }
        },
    },
};
</script>

<style scoped>
.container {
    max-width: 600px;
    margin: auto;
    padding: 20px;
}

.form-group {
    margin-bottom: 15px;
}

.error {
    color: red;
}
</style>