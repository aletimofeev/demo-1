import { Entity, MODULE } from "./const";
import { SET_ENTITY } from "../../mutation-types";

const module = MODULE;

export default {
  async setAuth({ dispatch, commit }) {
    const token = this.$jwt.getToken();
    if (token) {
      this.$api.auth.setAuthHeader(token);
      const value = await dispatch("getMe");
      if (value) {
        commit(
          SET_ENTITY,
          { module, entity: Entity.IS_AUTHENTICATED, value },
          { root: true }
        );
        return true;
      }
    }
    return false;
  },

  async login({ commit, dispatch }, credentials) {
    try {
      const { token } = await this.$api.auth.login(credentials);
      this.$jwt.saveToken(token);
      this.$api.auth.setAuthHeader(token);
      commit(
        SET_ENTITY,
        { module, entity: Entity.IS_AUTHENTICATED, value: true },
        { root: true }
      );

      await dispatch("getMe", null);
      return true;
    } catch (e) {
      console.log(e);
      this.$notifier.error("Неверный адрес или пароль");
      return false;
    }
  },

  async logout({ commit }, sendRequest = true) {
    if (sendRequest) {
      // await this.$api.auth.logout();
      // console.log(sendRequest);
    }
    this.$jwt.destroyToken();
    this.$api.auth.setAuthHeader(null);

    commit(
      SET_ENTITY,
      { module, entity: Entity.IS_AUTHENTICATED, value: false },
      { root: true }
    );

    commit(
      SET_ENTITY,
      { module, entity: Entity.USER, value: null },
      { root: true }
    );
  },

  async getMe({ commit, dispatch }, data = null) {
    try {
      if (!data) {
        data = await this.$api.auth.getMe();
      }
      commit(
        SET_ENTITY,
        { module, entity: Entity.USER, value: data },
        { root: true }
      );
      return true;
    } catch {
      await dispatch("logout", false);
      return false;
    }
  },
};
