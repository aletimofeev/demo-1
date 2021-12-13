import axios from "../../plugins/axios";
import { BaseApiService } from "./base";

const config = {headers: {'Accept': 'application/ld+json'} }

export default class CrudApiService extends BaseApiService {
  constructor(resource, notifier) {
    super(resource, notifier);
    this._resource = resource;
  }

  _resource;

  async get(uri = null) {
    if (uri && uri.charAt(0) !== "?") {
      uri = `/${uri}`;
    }
    const url = uri ? `${this._resource}${uri}` : this._resource;
    const { data } = await axios.get(url, config);
    return data;
  }

  async getOne(id, uri) {
    const url = uri
      ? `${this._resource}/${uri}/${id}`
      : `${this._resource}/${id}`;
    const { data } = await axios.get(url, config);
    return data;
  }

  async post(entity, uri = null) {
    const url = uri ? `${this._resource}/${uri}` : this._resource;
    const { data } = await axios.post(url, entity, config);
    return data;
  }

  async put(entity, id = null) {
    const url = id
      ? `${this._resource}/${id}`
      : `${this._resource}/${entity.id}`;
    const { data } = await axios.put(url, entity, config);
    return data;
  }

  async delete(id) {
    const { data } = await axios.delete(`${this._resource}/${id}`, config);
    return data;
  }
}
