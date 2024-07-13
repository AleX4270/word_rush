import { Component, inject } from '@angular/core';
import { RouterLink } from "@angular/router";
import { TranslateModule, TranslateService } from '@ngx-translate/core';

@Component({
  selector: 'app-start-page',
  standalone: true,
    imports: [
        RouterLink,
        TranslateModule
    ],
  templateUrl: './start-page.component.html',
  styleUrl: './start-page.component.scss'
})
export class StartPageComponent {
    private readonly translate: TranslateService = inject(TranslateService);

    switchLanguage(): void {
        if(this.translate.currentLang == 'pl') {
            this.translate.use('en');
        }
        else {
            this.translate.use('pl');
        }
    }
}
