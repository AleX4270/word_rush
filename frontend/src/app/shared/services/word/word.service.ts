import { Injectable } from '@angular/core';
import { RestService } from "../rest.service";
import { Observable } from "rxjs";
import { environment } from "../../../../environments/environment";
import { LettersResponse, WordCheckResponse } from "../../types/word.types";

@Injectable({
  providedIn: 'root'
})
export class WordService extends RestService {

    public getLettersData(secondsElapsed: number, languageSymbol: string): Observable<LettersResponse> {
        return this.http.get<LettersResponse>(`${environment.backendUrl}/api/words/letters?seconds=${secondsElapsed}
        ?language=${languageSymbol}`);
    }

    public checkWordCorrectness(data: any): Observable<WordCheckResponse> {
        return this.http.post<WordCheckResponse>(`${environment.backendUrl}/api/words/${data.id}/check`, data);
    }
}
