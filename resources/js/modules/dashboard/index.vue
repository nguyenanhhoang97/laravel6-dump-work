<template>
  <div class="dashboard">
    <div class="row">
      <div class="col-lg-6 col-md-6">
        <div class="card card-stats">
          <div class="card-body">
            <div class="row">
              <div class="col-5">
                <div class="info-icon text-center icon-success">
                  <i class="tim-icons icon-single-02"></i>
                </div>
              </div>
              <div class="col-7">
                <div class="numbers">
                  <p class="card-category">Users</p>
                  <h3 class="card-title">{{ totalUser }}</h3>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <hr />
            <div class="stats">
              <i class="tim-icons icon-single-02"></i> Users of Dump Work
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6">
        <div class="card card-stats">
          <div class="card-body">
            <div class="row">
              <div class="col-5">
                <div class="info-icon text-center icon-danger">
                  <i class="tim-icons icon-molecule-40"></i>
                </div>
              </div>
              <div class="col-7">
                <div class="numbers">
                  <p class="card-category">Projects</p>
                  <h3 class="card-title">{{ totalProject }}</h3>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <hr />
            <div class="stats">
              <i class="tim-icons icon-molecule-40"></i> Projects of Dump Work
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapState } from "vuex";

export default {
  middleware: "auth",

  data() {
    return {};
  },

  computed: {
    ...mapState("dashboard", ["totalProject", "totalUser"]),
    ...mapState("auth", ["user"]),
    ...mapState("global", ["routes"]),

    currentRoute() {
      return this.$route.name;
    }
  },

  created() {
    if (!this.checkRolePage()) {
      this.$router.push({ name: "projects" });
    }
    this.initData();
  },

  methods: {
    ...mapActions("dashboard", ["getDashboardData"]),

    initData() {
      this.getDashboardData();
    },

    checkRolePage() {
      const currentRole = this.currentRoute;
      const idx = this.routes.findIndex(elm => elm.name === currentRole);
      const { roles } = this.routes[idx];
      const { role_code: role } = this.user;
      const checked = roles.includes(role);
      return !!checked;
    }
  }
};
</script>

<style lang="scss" scoped>
.tim-icons {
  padding: 9px 15px !important;
}
</style>
