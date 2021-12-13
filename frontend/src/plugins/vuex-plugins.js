import JWTService from "@/service/jwt.service";
import createResource from "@/utils/create-store-resources";
import Notifier from "@/plugins/notifier";

export default (store) => {
  store.$jwt = JWTService;
  store.$notifier = new Notifier(store);
  store.$api = createResource(store.$notifier);
};
