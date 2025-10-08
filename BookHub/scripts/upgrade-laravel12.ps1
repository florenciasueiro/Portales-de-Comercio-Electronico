<#
  Script: upgrade-laravel12.ps1
  Objetivo: Verificar requisitos (PHP >= 8.3), actualizar Composer y dependencias,
            limpiar caches y mostrar estado de la app para migrar a Laravel 12.
#>

#requires -Version 5.1
Set-StrictMode -Version Latest
$ErrorActionPreference = 'Stop'

Write-Host "== Comprobando requisitos para Laravel 12 ==" -ForegroundColor Cyan

function Require-Command($cmd, $name) {
  try {
    $null = & $cmd --version
  } catch {
    Write-Error "$name no está instalado o no es accesible en PATH."
    exit 1
  }
}

function Get-PhpVersion() {
  $out = & php -v 2>&1
  if ($LASTEXITCODE -ne 0) { throw "PHP no disponible" }
  $m = [regex]::Match($out, 'PHP\s+(\d+\.\d+\.\d+)')
  if (-not $m.Success) { throw "No pude detectar versión de PHP" }
  return [version]$m.Groups[1].Value
}

Require-Command 'php' 'PHP'
Require-Command 'composer' 'Composer'

$phpVer = Get-PhpVersion
Write-Host "PHP detectado: $($phpVer.ToString())"

$minPhp = [version]'8.3.0'
if ($phpVer -lt $minPhp) {
  Write-Error "Se requiere PHP $($minPhp.ToString()) o superior para Laravel 12."
  exit 1
}

# Ubicar carpeta del proyecto (BookHub)
$projRoot = Split-Path -Parent $PSScriptRoot
if (Test-Path (Join-Path $projRoot 'composer.json')) {
  Set-Location $projRoot
} else {
  Write-Warning "Ejecutando en $PWD; asegurate de correr esto dentro de 'BookHub'."
}

Write-Host "== Actualizando Composer y dependencias ==" -ForegroundColor Cyan
& composer self-update
& composer update

Write-Host "== Limpieza de caches de Laravel ==" -ForegroundColor Cyan
& php artisan config:clear
& php artisan cache:clear
& php artisan route:clear

Write-Host "== Estado de la app ==" -ForegroundColor Cyan
& php artisan about

Write-Host "Upgrade a Laravel 12 completado. Revisá warnings y corré 'php artisan serve'." -ForegroundColor Green