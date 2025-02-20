<template>
    <div class="container">
        <h2>Publicaciones</h2>
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
                    <td>{{ publication.fecha_creacion }}</td>
                    <td>{{ publication.usuario.nombre }} ({{ publication.usuario.rol }})</td>
                    <td>
                        <button @click="editPublication(publication.id)">Editar</button>
                        <button @click="deletePublication(publication.id)">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            publications: [],
        };
    },
    created() {
        this.fetchPublications();
    },
    methods: {
        async fetchPublications() {
            try {
                const response = await axios.get('http://localhost:8000/publicaciones', {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`,
                    },
                });
                this.publications = response.data;
            } catch (error) {
                console.error('Error al obtener publicaciones:', error);
            }
        },
        async deletePublication(id) {
            try {
                await axios.delete(`http://localhost:8000/publicaciones/${id}`, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`,
                    },
                });
                this.fetchPublications(); // Refrescar la lista después de eliminar
            } catch (error) {
                console.error('Error al eliminar publicación:', error);
            }
        },
        editPublication(id) {
            this.$router.push({ name: 'EditPublication', params: { id } });
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
</style>