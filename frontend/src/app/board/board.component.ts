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
    public lettersData: LettersData = {} as LettersData;
    public counter: number = 0;
    public isWordDataLoading: boolean = false;
    public guessedWord: string = '';

    constructor(
        private readonly wordService: WordService
    ) {}

    @HostListener('window:keydown', ['$event'])
    public handleStartGame(event: KeyboardEvent) {
        if(event.code !== 'Space' || this.isWordDataLoading) return;

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
        this.isWordDataLoading = true;
        this.wordService.getLettersData({secondsElapsed: this.counter}).subscribe({
            next: (response) => {
                this.lettersData = response.data;
                this.isWordLettersDataLoaded = true;
                console.log(this.lettersData);
            },
            error: (error) => {
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
                console.log(response.data.isValid);
            },
            error: (error) => {
                console.error(error);
            },
        });
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