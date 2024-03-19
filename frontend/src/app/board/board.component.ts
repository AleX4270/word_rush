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
    private intervalId!: number;

    public isGameStarted: boolean = false;
    public lettersData: LettersData = {} as LettersData;
    public wordData: WordData = {} as WordData;
    public counter: number = 0;
    public isWordDataLoading: boolean = false;

    constructor() {
        this.lettersData.letters = ['w', 'o', 'r', 'd'];
        this.wordData.word = 'word';
    }

    @HostListener('window:keydown', ['$event'])
    public handleStartGame(event: KeyboardEvent) {
        if(event.code !== 'Space' || this.isWordDataLoading) return;

        if(!this.isGameStarted) {
            console.log('game started!');
            this.startCounter();
            this.isGameStarted = true;
        }
        else {
            console.log('game stopped!');
            this.stopCounter();
            this.isGameStarted = false;
        }
    }

    private getWordData(): void {
        this.isWordDataLoading = true;
        //TODO: Add logic to get word from API
    }

    public startCounter(): void {
        this.counter = 0;
        this.intervalId = setInterval(() => {
            this.counter++;
        }, 1000);
    }

    public stopCounter(): void {
        clearInterval(this.intervalId);
        this.getWordData();
    }
}