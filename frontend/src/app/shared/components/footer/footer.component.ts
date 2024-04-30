import { Component } from '@angular/core';
import { environment } from "../../../../environments/environment";
import { LangChangeEvent, TranslateModule, TranslateService } from "@ngx-translate/core";
import { LANG_PL, LANG_EN } from "../../types/language.types";

@Component({
  selector: 'app-footer',
  standalone: true,
    imports: [
        TranslateModule
    ],
  templateUrl: './footer.component.html',
  styleUrl: './footer.component.scss'
})
export class FooterComponent {
    public appVersion: string;
    public currentYear: number;
    public currentLanguageSymbol!: string;

    protected readonly LANG_PL = LANG_PL;
    protected readonly LANG_EN = LANG_EN;

    constructor(
        private readonly translate: TranslateService
    ) {
        this.appVersion = environment.appVersion;
        this.currentYear = new Date().getFullYear();

        this.translate.onLangChange.subscribe((e: LangChangeEvent) => {
            this.currentLanguageSymbol = e.lang;
        });
    }

    public changeLanguage(): void {
        this.translate.use(this.currentLanguageSymbol === LANG_PL ? LANG_EN : LANG_PL);
    }
}
