// Only for close the search box
// import StimulusBridge from '@symfony/stimulus-bridge';
import { Controller } from '@hotwired/stimulus';
import { useClickOutside } from 'stimulus-use';


// import { Controller } from 'stimulus';
// import { useClickOutside } from 'stimulus-use';
/* stimulusFetch: 'lazy' */
export default class extends Controller {
    static values = {
        url: String,
    }
    static targets = ['result'];
    connect() {
        useClickOutside(this);
    }
    async onSearchInput(event) {
        const params = new URLSearchParams({
            science: event.currentTarget.value,
            preview: 1,
        });
        const response = await fetch(`${this.urlValue}?${params.toString()}`);
        this.resultTarget.innerHTML = await response.text();
    }
    clickOutside(event) {
        this.resultTarget.innerHTML = '';
       
    }
}
