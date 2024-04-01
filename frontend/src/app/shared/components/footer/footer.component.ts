import { Component } from '@angular/core';
import { environment } from "../../../../environments/environment";

@Component({
  selector: 'app-footer',
  standalone: true,
  imports: [],
  templateUrl: './footer.component.html',
  styleUrl: './footer.component.scss'
})
export class FooterComponent {
    public appVersion: string;
    public currentYear: number;

    constructor() {
        this.appVersion = environment.appVersion;
        this.currentYear = new Date().getFullYear();
    }
}
