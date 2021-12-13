import { NotificationTypes } from "@/utils/const";

export default class Notifier {
  constructor(store) {
    this._store = store;
  }

  _store;

  info(text) {
    this._store.dispatch("createNotification", {
      text,
      type: NotificationTypes.INFO,
    });
  }

  success(text) {
    this._store.dispatch("createNotification", {
      text,
      type: NotificationTypes.SUCCESS,
    });
  }

  error(text) {
    this._store.dispatch("createNotification", {
      text,
      type: NotificationTypes.DANGER,
    });
  }

  warning(text) {
    this._store.dispatch("createNotification", {
      text,
      type: NotificationTypes.WARNING,
    });
  }
}
