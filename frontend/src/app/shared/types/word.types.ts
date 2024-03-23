export interface LettersData {
    wordId: number,
    letters: string[],
}

export interface WordCheckData {
    isValid: boolean,
}

export interface LettersResponse extends Response {
    data: LettersData
}

export interface WordCheckResponse extends Response {
    data: WordCheckData
}