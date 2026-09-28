
import { renderUsers } from './scripts/dom/render.js';

const apiUrl = import.meta.env.VITE_API_URL ?? 'http://localhost:8000/api/users';

// Quando o DOM estiver pronto, renderiza a lista
document.addEventListener('DOMContentLoaded', async () => {
    try {
        await renderUsers(apiUrl);
    } catch (error) {
        // Na Etapa 5 trocamos isso por uma mensagem na tela
        console.error(error);
    }
});