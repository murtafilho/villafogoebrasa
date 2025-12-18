# MCP no VS Code (Claude Code)

## Arquivo
```
C:\laragon\www\vilafogoebrasa-prod\.mcp.json
```

## Configuração Atual do Projeto

```json
{
  "mcpServers": {
    "laravel-boost": {
      "type": "stdio",
      "command": "php",
      "args": ["artisan", "boost:mcp"],
      "env": {}
    },
    "tailwindcss": {
      "type": "stdio",
      "command": "npx",
      "args": ["-y", "tailwindcss-mcp-server"],
      "env": {}
    }
  }
}
```

---

## Problema: MCPs não conectam

### Passo 1: Verificar status
```bash
claude mcp list
```

### Passo 2: Se aparecer erro, remover e adicionar novamente
```bash
claude mcp remove laravel-boost
claude mcp remove tailwindcss

claude mcp add --transport stdio laravel-boost --scope project -- php artisan boost:mcp
claude mcp add --transport stdio tailwindcss --scope project -- npx -y tailwindcss-mcp-server
```

### Passo 3: Verificar novamente
```bash
claude mcp list
```

Deve mostrar:
```
laravel-boost: ✓ Connected
tailwindcss: ✓ Connected
```

---

## Problema: npx falha ou demora

```bash
npm cache clean --force
npm install -g tailwindcss-mcp-server
```

Depois altere o .mcp.json:
```json
"tailwindcss": {
  "type": "stdio",
  "command": "tailwindcss-mcp-server",
  "args": [],
  "env": {}
}
```

---

## Problema: PHP não encontrado

Verificar se PHP está no PATH:
```bash
php -v
```

Se não estiver, usar caminho completo no .mcp.json:
```json
"command": "C:\\laragon\\bin\\php\\php-8.4\\php.exe"
```

---

## Comandos Úteis

| Ação | Comando |
|------|---------|
| Ver status | `claude mcp list` |
| Adicionar | `claude mcp add --transport stdio <nome> --scope project -- <cmd>` |
| Remover | `claude mcp remove <nome>` |
| Detalhes | `claude mcp get <nome>` |

---

## Reiniciar Claude Code

Após qualquer alteração: `Ctrl+Shift+P` → "Developer: Reload Window"
