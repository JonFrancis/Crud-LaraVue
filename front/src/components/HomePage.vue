<!-- Home Page -->
<template>
  <!-- Adding Header -->
  <HeaderPage></HeaderPage>
  <!-- Table of users -->
  <div class="container-fluid my-3" v-if="users.length != 0">
    <h2 class="my-2"> All Users </h2>
    <table class="table table-striped">
      <thead class="table-dark">
        <tr>
          <th scope="col"> Username </th>
          <th scope="col"> First Name </th>
          <th scope="col"> Last Name </th>
          <th scope="col"> Age </th>
          <th scope="col"> Cellphone </th>
          <th scope="col"> Actions </th>
        </tr>
      </thead>  
      <tbody>
        <tr v-for="user in users" :key="user.id">
          <td scope="row"> {{ user.Username }} </td>
          <td> {{ user.First_Name }} </td>
          <td> {{ user.Last_Name }} </td>
          <td> {{ user.Age }} </td>
          <td> {{ user.Cellphone }} </td>
          <td>
            <RouterLink :to="user.id + '/edit'" class="btn btn-outline-info mx-2 b-black">
              Edit User
            </RouterLink>
            <button type="button" class="btn btn-outline-danger b-black" @click="deleteUser(user.id)">
              Delete User
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div v-else class="my-3">
    <h2>
      {{ error }}
    </h2>
  </div>
</template>

<script>
import HeaderPage from './HeaderPage.vue';
import axios from 'axios'
//import bootstrap from 'bootstrap';
import "bootstrap/dist/css/bootstrap.css"
import "bootstrap/dist/js/bootstrap.js"

export default {
  name: 'HomePage',
  components: {
    HeaderPage
  },
  data() {
    return {
      users: [],
      error: "",
    }
  },
  methods: {
    //Get Users, or message of empty database
    async fetchUsers() {
      try {
        const result = await axios.get("http://127.0.0.1:8000/api/allusers")
        this.users = result.data.allusers
      } catch (error) {
        this.error = error.response.data.message
      }
    },
    //Confirmation before delete, and message that user don't exist if delete fails
    async deleteUser(id) {
      let confirmation = confirm("Are you sure you want to delete this user?")
      if (confirmation) {
        try {
          await axios.delete(`http://127.0.0.1:8000/api/allusers/${id}/delete`)
          location.reload()
        } catch (error) {
          alert(error.response.data.message)
        }
      }
    }
  },
  //Mount
  mounted() {
    this.fetchUsers()
  }
}
</script>

<!-- Changing the font in project -->
<style>
  @import url('https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@1,300;1,900&display=swap');
  h2{
    font-family: 'Merriweather', serif;
    font-weight: 900;
    font-style: italic;
    text-align: center;
  }
  table{
    font-family: 'Merriweather', serif;
    font-weight: 400;
    font-style: italic;
  }
  .b-black {
    font-family: 'Merriweather', serif;
    font-weight: 900;
    font-style: italic;
  }
</style>
