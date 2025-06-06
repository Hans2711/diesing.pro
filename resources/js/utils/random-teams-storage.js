const STORAGE_KEY = 'random_teams_state';

function initRandomTeamsStorage() {
    const body = document.querySelector('body');
    if (!body || body.dataset.userLoggedIn === '1') {
        return;
    }

    window.addEventListener('random-teams-save', (e) => {
        try {
            localStorage.setItem(STORAGE_KEY, JSON.stringify(e.detail));
        } catch (err) {
            console.warn('Could not save random teams state', err);
        }
    });

    window.addEventListener('random-teams-request-state', () => {
        try {
            const stored = localStorage.getItem(STORAGE_KEY);
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
if (window.Livewire) {
    Livewire.hook('morphed', initRandomTeamsStorage);
}
