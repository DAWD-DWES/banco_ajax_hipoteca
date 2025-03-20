<?php

namespace App\modelo;

enum TipoCuenta: string {
    case CORRIENTE = 'Cuenta Corriente';
    case AHORROS = 'Cuenta Ahorros';
}
