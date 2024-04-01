import { Component, HostListener } from '@angular/core';
import { LettersData } from "../shared/types/word.types";
import { WordService } from "../shared/services/word/word.service";
import { RouterLink } from "@angular/router";
import { FormsModule } from "@angular/forms";

@Component({
    selector: 'app-board',
    standalone: true,
    imports: [
        RouterLink,
        FormsModule
    ],
    templateUrl: './board.component.html',
    styleUrl: './board.component.scss'
})
export class BoardComponent {
    private intervalId!: number;

    public isCounterStarted: boolean = false;
    public isWordLoaded: boolean = false;
    public isWordDataLoading: boolean = false;
    public isWordCorrectnessValidated: boolean = false;
    public isGuessCorrect: boolean = false;

    public lettersData: LettersData = {} as LettersData;
    public counter: number = 0;
    public guessedWord: string = '';


    constructor(
        private readonly wordService: WordService
    ) {}

    @HostListener('window:keydown', ['$event'])
    public handleStartGame(event: KeyboardEvent) {
        if(event.code !== 'Space' || this.isWordDataLoading || this.isWordLoaded) return;

        if(!this.isCounterStarted) {
            this.startCounter();
        }
        else {
            this.stopCounter();
        }
    }

    private getWordData(): void {
        console.log(this.counter);
        this.isWordDataLoading = true;
        this.wordService.getLettersData(this.counter).subscribe({
            next: (response) => {
                this.lettersData = response.data;
                this.isWordDataLoading = false;
                this.isWordLoaded = true;

                if(this.lettersData.hiddenLettersCount < 1) {
                    this.isWordCorrectnessValidated = true;
                    this.isGuessCorrect = false;
                }
                console.log(this.lettersData);
            },
            error: (error) => {
                this.isWordDataLoading = false;
                console.error(error);
            },
        });
    }

    public checkWordCorrectness(): void {
        const data: any = {
            id: this.lettersData.wordId,
            word: this.guessedWord,
        }

        this.wordService.checkWordCorrectness(data).subscribe({
            next: (response) => {
                this.isGuessCorrect = response.data.isValid;
                this.isWordCorrectnessValidated = true;
                console.log(response.data.isValid);
            },
            error: (error) => {
                console.error(error);
                this.isWordCorrectnessValidated = true;
            },
        });
    }

    public resetGame(): void {
        this.counter = 0;
        this.isWordLoaded = false;
        this.isWordCorrectnessValidated = false;
        this.guessedWord = '';
    }

    public startCounter(): void {
        this.counter = 0;
        this.isCounterStarted = true;
        this.intervalId = setInterval(() => {
            this.counter++;
        }, 1000);
    }

    public stopCounter(): void {
        clearInterval(this.intervalId);
        this.isCounterStarted = false;
        this.getWordData();
    }
}