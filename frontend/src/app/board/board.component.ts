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

    public isGameStarted: boolean = false;
    public isWordLettersDataLoaded: boolean = false;
    public isWordDataLoading: boolean = false;
    public isWordValidated: boolean = false;
    public isGuessCorrect: boolean = false;

    public lettersData: LettersData = {} as LettersData;
    public counter: number = 0;
    public guessedWord: string = '';


    constructor(
        private readonly wordService: WordService
    ) {}

    @HostListener('window:keydown', ['$event'])
    public handleStartGame(event: KeyboardEvent) {
        if(event.code !== 'Space' || this.isWordDataLoading || this.isWordLettersDataLoaded) return;

        if(!this.isGameStarted) {
            this.startCounter();
            this.isGameStarted = true;
        }
        else {
            this.stopCounter();
            this.isGameStarted = false;
        }
    }

    private getWordData(): void {
        console.log(this.counter);
        this.isWordDataLoading = true;
        this.wordService.getLettersData(this.counter).subscribe({
            next: (response) => {
                this.lettersData = response.data;
                this.isWordLettersDataLoaded = true;
                this.isWordDataLoading = false;
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
                this.isWordValidated = true;
                console.log(response.data.isValid);
            },
            error: (error) => {
                console.error(error);
                this.isWordValidated = true;
            },
        });
    }

    public resetGame(): void {
        this.counter = 0;
        this.isGameStarted = false;
        this.isWordLettersDataLoaded = false;
        this.isWordValidated = false;
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