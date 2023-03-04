<script>
  import { mapActions, mapState } from "pinia";
  import { useWeatherStore } from "@/stores/weather";
  import UserList from "@/components/UserList.vue";

  // const baseUrl = process.env.VUE_APP_API_URL as unknown as string;

  export default {
    components: { UserList },

    data: () => ({
      apiResponse: null,
    }),

    computed: {
      ...mapState(useWeatherStore, ["getUsers"]),
    },

    created() {
      this.fetchData();
    },

    methods: {
      ...mapActions(useWeatherStore, ["fetchData"]),
    },
  };
</script>

<template>
  <div v-if="getUsers?.length === 0 || !getUsers">
    Pinging the api...
    <div class="p-4 flex justify-center">
      <p class="mt-2 text-sm text-gray-700">
        Unable to get users currently, kindly try again in a few min.
      </p>
    </div>
  </div>

  <div v-if="getUsers.length > 0">
    <!-- The api responded with: <br />
    <code>
      {{ apiResponse }}
    </code> -->

    <div>
      <div class="sm:flex sm:items-center sm:mb-16">
        <div class="sm:flex-auto">
          <h1 class="text-3xl font-semibold leading-6 text-gray-900">Users</h1>
          <p class="mt-2 text-sm text-gray-700">
            A list of all users with a weather reports based on their
            geo-coordinates. Click on view to see more details.
          </p>
        </div>
      </div>
      <div class="mt-6 flow-root">
        <ul role="list" class="-my-5 divide-y divide-gray-200">
          <UserList
                  v-for="person in getUsers"
                  :person="person"
                  :key="person.id"
                  class="py-4"
          />
        </ul>
      </div>
    </div>
  </div>
</template>