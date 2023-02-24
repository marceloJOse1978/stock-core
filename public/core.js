/* #! /usr/bin/env node

const { exec } = require('child_process');
const path = require("path");

console.log("===Instalando dependências===");
exec(`git clone https://github.com/marceloJOse1978/pos-1.0.2lst.git`, (error, stdout, stderr) => {
    if (error) {
        console.log(`error: ${error.message}`);
        return
    }
    if (stderr) {
        console.log(`stderr: ${stderr}`);
    }
    console.log("PACOTE PRONTO !")
}); */
function pack() { 
}

const shell = require('shelljs');
 
if (!shell.which('git')) {
  shell.echo('Desculpe, este script requer o git.');
  shell.exit(1);
}
shell.cd('extensions');
 
// Executar ferramenta externa de forma síncrona 
if (shell.exec('git clone https://github.com/marceloJOse1978/pos-1.0.2lst.git').code !== 0) {
  shell.echo('Error: Git commit failed');
  shell.exit(1);
}
