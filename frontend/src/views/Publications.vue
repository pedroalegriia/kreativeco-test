<template>
    <div class="container">
        <h2>Publicaciones</h2>
        <button @click="createPublication">Crear Nueva Publicación</button>
        <p v-if="error" class="error">{{ error }}</p>
        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Fecha de Creación</th>
                    <th>Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="publication in publications" :key="publication.id">
                    <td>{{ publication.titulo }}</td>
                    <td>{{ publication.descripcion }}</td>
                    <td>{{ formatDate(publication.fecha_creacion) }}</td>
                    <td>{{ publication.nombre_usuario }}</td>
                    <td>
                        <button @click="editPublication(publication)">Editar</button>
                        <button @click="deletePublication(publication.id)">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from '../axios.js'; 

export default {
    data() {
        return {
            publications: [],
            error: null, 
        };
    },
    created() {
        this.fetchPublications();
    },
    methods: {
        async fetchPublications() {
            try {
                const response = await axios.get('/publicaciones'); 
                const data = response.data; 
                const tokenMatch = data.match(/"(.*?)"/); 
                const token = tokenMatch ? tokenMatch[1] : null;

                const publicationsMatch = data.match(/\[(.*)\]/); 
                const publications = publicationsMatch ? JSON.parse(publicationsMatch[0]) : [];

                if (token) {
                    localStorage.setItem('token', token); 
                }
                this.publications = publications; 
                this.error = null; 
            } catch (error) {
                console.error('Error al obtener publicaciones:', error);
                this.error = 'No se pudieron cargar las publicaciones.';
            }
        },
        async deletePublication(id) {
            if (confirm('¿Estás seguro de que deseas eliminar esta publicación?')) {
                try {
                    await axios.delete(`/publicaciones/${id}`); 
                    this.fetchPublications(); 
                } catch (error) {
                    console.error('Error al eliminar publicación:', error);
                    this.error = 'No se pudo eliminar la publicación.'; 
                }
            }
        },

        editPublication(publication) {
            this.$router.push({
                name: 'EditPublication',
                params: {
                    id: publication.id,
                    titulo: publication.titulo,
                    descripcion: publication.descripcion
                }
            });
        },
        createPublication() {
            this.$router.push({ name: 'CreatePublication' });
        },
        formatDate(dateString) {
            if (!dateString) {
                return 'Fecha no disponible';
            }

            const date = new Date(dateString);
            if (isNaN(date.getTime())) {
                return 'Fecha inválida'; 
            }

            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return date.toLocaleDateString(undefined, options);
        },
    },
};
</script>

<style scoped>
.container {
    max-width: 800px;
    margin: auto;
    padding: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th,
td {
    border: 1px solid #ddd;
    padding: 8px;
}

th {
    background-color: #f2f2f2;
}

button {
    margin-right: 5px;
}

.error {
    color: red;
}
</style>