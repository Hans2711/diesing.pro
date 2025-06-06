const STORAGE_KEY = 'random_teams_state';

function initRandomTeamsStorage() {
    const body = document.querySelector('body');
    if (!body || body.dataset.userLoggedIn === '1') {
        return;
    }

    console.log('Initializing random teams storage');

    window.addEventListener('random-teams-save', (e) => {
        try {
            console.log('Saving random teams state', e.detail);
            localStorage.setItem(STORAGE_KEY, JSON.stringify(e.detail));
        } catch (err) {
            console.warn('Could not save random teams state', err);
        }
    });

    window.addEventListener('random-teams-request-state', () => {
        try {
            const stored = localStorage.getItem(STORAGE_KEY);
            console.log('Requesting random teams state', stored);
            if (stored) {
                Livewire.dispatch('loadState', JSON.parse(stored));
            }
        } catch (err) {
            console.warn('Could not load random teams state', err);
        }
    });
}

document.addEventListener('DOMContentLoaded', initRandomTeamsStorage);
document.addEventListener('livewire:navigated', initRandomTeamsStorage);
initRandomTeamsStorage();
