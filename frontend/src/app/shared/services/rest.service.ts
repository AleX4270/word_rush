import { Injectable } from '@angular/core';
import { HttpClient } from "@angular/common/http";

@Injectable({
  providedIn: 'root'
})
export class RestService {
    constructor(
        protected readonly http: HttpClient,
    ) {}

    protected getParamsFromObject(obj: Object) {
        return Object.entries(obj).map(([key, val]) => `${key}=${val}`).join('&');
    }
}
