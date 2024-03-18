import { Component, HostListener } from '@angular/core';
import { LettersData, WordData } from "../shared/types/word.types";

@Component({
    selector: 'app-board',
    standalone: true,
    imports: [],
    templateUrl: './board.component.html',
    styleUrl: './board.component.scss'
})
export class BoardComponent {
    public isGameStarted: boolean = false;
    public lettersData: LettersData = {} as LettersData;
    public wordData: WordData = {} as WordData;
    constructor() {
        this.lettersData.letters = ['w', 'o', 'r', 'd'];
        this.wordData.word = 'word';
    }

    @HostListener('window:keydown', ['$event'])
    public handleStartGame(event: KeyboardEvent) {
        if(event.code === 'Space') {
            console.log('game started!');
            this.isGameStarted = true;
        }
    }


}
