import { Injectable } from '@angular/core';
import { RestService } from "../rest.service";
import { Observable } from "rxjs";
import { environment } from "../../../../environments/environment";

@Injectable({
  providedIn: 'root'
})
export class WordService extends RestService {

    // public getWordData(data: any): Observable<any> { //TODO: Add observable type instead of any
    //     return this.http.get<any>(`${environment.backendUrl}/word/api/get-word-data?word=${data}`);
    // }
}
