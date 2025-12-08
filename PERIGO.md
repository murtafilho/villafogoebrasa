# PERIGO: Cache de Rotas no Laravel em Subdiretório

## O Problema

Este projeto está hospedado em um **subdiretório** (`/villafogoebrasa`) no servidor Hostinger, não na raiz do domínio. Isso causa um conflito com o cache de rotas do Laravel.

### Erro que ocorre:
```
Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException
The GET method is not supported for route /. Supported methods: HEAD.
```

### Causa:
Quando executamos `php artisan optimize` ou `php artisan route:cache`, o Laravel serializa as rotas. O servidor LiteSpeed (Hostinger) adiciona um trailing slash (`/villafogoebrasa/`) que conflita com a rota cacheada (`/`).

## Solução

### NO DEPLOY, NUNCA USE:
```bash
php artisan optimize        # NÃO USE!
php artisan route:cache     # NÃO USE!
```

### USE APENAS:
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## Comando de Deploy Seguro

```bash
ssh taiyo "cd ~/villafogoebrasa && git pull && php artisan cache:clear && php artisan config:clear && php artisan route:clear && php artisan view:clear"
```

## Se o Erro Ocorrer

Execute no servidor:
```bash
ssh taiyo "cd ~/villafogoebrasa && rm -rf bootstrap/cache/*.php && php artisan route:clear && php artisan cache:clear && php artisan config:clear"
```

## Resumo

| Comando | Status |
|---------|--------|
| `php artisan optimize` | PROIBIDO |
| `php artisan route:cache` | PROIBIDO |
| `php artisan config:cache` | OK (opcional) |
| `php artisan view:cache` | OK (opcional) |
| `php artisan cache:clear` | OK |
| `php artisan route:clear` | OBRIGATÓRIO |

## Por que isso acontece?

1. O site está em `https://murtafilho.net/villafogoebrasa/`
2. O Laravel espera estar na raiz `/`
3. O cache de rotas serializa a rota como `/`
4. O LiteSpeed redireciona `/villafogoebrasa` para `/villafogoebrasa/`
5. O Laravel cacheado não reconhece a rota com trailing slash
6. Resultado: erro 405 Method Not Allowed
