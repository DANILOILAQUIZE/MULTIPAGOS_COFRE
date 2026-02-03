<?php
  echo '
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
        
        <li class="nav-item">
          <a href="../../../menu.php" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
            Dashboard              
            </p>
          </a>
        </li>
        <li class="nav-header">FACTURACION</li>
            <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                Punto de Venta
                <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="../../../modulos/E - Facturacion/pedidos.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Facturar</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="../../modulos/pedidos/facturacion.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Facturacion Electronica</p>
                </a>
                </li>
            </ul>
            </li>
            <li class="nav-item">
            <a href="../../modulos/administracion/tickets.php" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                Reportes
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="../../modulos/administracion/reporte.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Reporte Ventas</p>
                </a>
                </li>                    
            </ul>
            
        </li>
        <li class="nav-item">
            <a href="../../modulos/administracion/tickets.php" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                Firma Electronica
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="../../modulos/administracion/reporte.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Clave / Firma</p>
                </a>
                </li>                    
            </ul>
            
        </li>
        
    <li class="nav-header">CONTABLE</li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                Activos Fijos
                <i class="fas fa-angle-left right"></i>
                </p>
            </a>
             <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="../../modulos/pedidos/pedidos.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Activos </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../../modulos/pedidos/facturacion.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                     <p>Transacciones Activos</p>
                    </a>
                </li>
             </ul>
        </li>
        <li class="nav-item">
            <a href="../../modulos/administracion/tickets.php" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
                <p> Inventario <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="../../modulos/administracion/reporte.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Ingresos Bodega</p>
                </a>
                </li>                    
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="../../modulos/administracion/reporte.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Egresos Bodega</p>
                </a>
                </li>                    
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="../../modulos/administracion/reporte.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pedidos a Bodega</p>
                </a>
                </li>                    
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="../../modulos/administracion/reporte.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Transacciones / Stock</p>
                </a>
                </li>                    
            </ul>
        </li>
        <li class="nav-item">
            <a href="../../modulos/administracion/tickets.php" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                    <p> Cuentas x Pagar <i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="../../modulos/administracion/reporte.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Ingreso Facturas Lote</p>
                    </a>
                    </li>                    
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="../../modulos/administracion/reporte.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Ingreso Manual</p>
                    </a>
                    </li>                    
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="../../modulos/administracion/reporte.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Registro CxP</p>
                    </a>
                    </li>                    
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="../../modulos/administracion/reporte.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Notas de Credito</p>
                    </a>
                    </li>                    
                </ul>
            </li>
            <li class="nav-item">
            <a href="../../modulos/administracion/tickets.php" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
                <p> Tesoreria <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="../../modulos/administracion/reporte.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Bancos</p>
                </a>
                </li>                    
            </ul>
            <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="../../modulos/administracion/reporte.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Libro Bancos</p>
            </a>
            </li>                    
        </ul>
        </li>
        <li class="nav-item">
        <a href="../../modulos/administracion/tickets.php" class="nav-link">
        <i class="nav-icon fas fa-chart-pie"></i>
            <p> Cuentas x Cobrar <i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="../../modulos/administracion/reporte.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Registro de Pagos</p>
            </a>
            </li>                    
        </ul>
        <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="../../modulos/administracion/reporte.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Estados de Cuenta</p>
            </a>
            </li>                    
        </ul>
        </li>
        <li class="nav-item">
        <a href="../../modulos/administracion/tickets.php" class="nav-link">
        <i class="nav-icon fas fa-chart-pie"></i>
            <p> Contabilidad <i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="../../modulos/administracion/reporte.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Plan de Cuentas</p>
            </a>
            </li>                    
        </ul>
        <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="../../modulos/administracion/reporte.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Asientos Contables</p>
            </a>
        </li>                    
         </ul>
        <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="../../modulos/administracion/reporte.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Reportes SRI</p>
            </a>
            </li>                    
        </ul>
        <ul class="nav nav-treeview">
        <li class="nav-item">
        <a href="../../modulos/administracion/reporte.php" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Retenciones</p>
        </a>
        </li>                    
        </ul>
    </li>

    <li class="nav-header">ADMINISTRATIVO</li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                Compras
                <i class="fas fa-angle-left right"></i>
                </p>
            </a>
             <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="../../modulos/pedidos/pedidos.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Requisiciones</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../../modulos/pedidos/facturacion.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                     <p>Cotizaciones</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../../modulos/pedidos/facturacion.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                     <p>Ordenes de Compra</p>
                    </a>
                </li>                
             </ul>
        </li>
        <li class="nav-item">
            <a href="../../modulos/administracion/tickets.php" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
                <p> Recursos Humanos <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="../../modulos/administracion/reporte.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Asistencias</p>
                </a>
                </li>   
                <li class="nav-item">
                <a href="../../modulos/administracion/reporte.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p> Novedades Asistencias</p>
                </a>
                </li> 
                <li class="nav-item">
                <a href="../../modulos/administracion/reporte.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Horarios</p>
                </a>
                </li>  
                <li class="nav-item">
                <a href="../../modulos/administracion/reporte.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Empleados</p>
                </a>
                </li> 
                <li class="nav-item">
                <a href="../../modulos/administracion/reporte.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Estructura Organizacional</p>
                </a>
                </li>  
                <li class="nav-item">
                <a href="../../modulos/administracion/reporte.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Nomina y Rol</p>
                </a>
                </li> 
                <li class="nav-item">
                <a href="../../modulos/administracion/reporte.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Liquidaciones</p>
                </a>
                </li>                
                <li class="nav-item">
                <a href="../../modulos/administracion/reporte.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Rubros</p>
                </a>
                </li> 
                <li class="nav-item">
                <a href="../../modulos/administracion/reporte.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Rubros Fijos</p>
                </a>
                </li> 
                <li class="nav-item">
                <a href="../../modulos/administracion/reporte.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Catering</p>
                </a>
                </li> 
                <li class="nav-item">
                <a href="../../modulos/administracion/reporte.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Reportes</p>
                </a>
                </li> 
            </ul>
        </li>                
    </li>

    <li class="nav-header">FLORICOLA</li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
            Cultivo
            <i class="fas fa-angle-left right"></i>
            </p>
        </a>
         <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="../../modulos/pedidos/pedidos.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Plano de Cultivo</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="../../modulos/pedidos/facturacion.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                 <p>Productividades Campo</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="../../modulos/pedidos/facturacion.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                 <p>Proyecciones</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="../../modulos/pedidos/facturacion.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                 <p>Monitoreo Plagas</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="../../modulos/pedidos/facturacion.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                 <p>Monitoreo Trips</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="../../modulos/pedidos/facturacion.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                 <p>Formularios Fumigacion</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="../../modulos/pedidos/facturacion.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                 <p>Ingreso Cosecha</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="../../modulos/pedidos/facturacion.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                 <p>Reporteria</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="../../modulos/pedidos/facturacion.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                 <p>Aprobacion Novedades</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="../../modulos/pedidos/facturacion.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                 <p>Solicitud Horas Extras</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="../../modulos/pedidos/facturacion.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                 <p>Impresion Tickets</p>
                </a>
            </li>
         </ul>
    </li>
    <li class="nav-item">
        <a href="../../modulos/administracion/tickets.php" class="nav-link">
        <i class="nav-icon fas fa-chart-pie"></i>
            <p> Postcosecha <i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="../../modulos/administracion/reporte.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Registro Sobrantes</p>
            </a>
            </li>
            <li class="nav-item">
            <a href="../../modulos/administracion/reporte.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Rendimientos</p>
            </a>
            </li>
            <li class="nav-item">
            <a href="../../modulos/administracion/reporte.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Transaccones</p>
            </a>
            </li>
            <li class="nav-item">
            <a href="../../modulos/administracion/reporte.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manejo Horas Extras</p>
            </a>
            </li> 
            <li class="nav-item">
            <a href="../../modulos/administracion/reporte.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Reporteria</p>
            </a>
            </li>
            <li class="nav-item">
            <a href="../../modulos/administracion/reporte.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Ingreso Flor Cultivo</p>
            </a>
            </li>
            <li class="nav-item">
            <a href="../../modulos/administracion/reporte.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Ingreso Flor Nacional</p>
            </a>
            </li>
            <li class="nav-item">
            <a href="../../modulos/administracion/reporte.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Ingreso Bunches</p>
            </a>
            </li>
            <li class="nav-item">
            <a href="../../modulos/administracion/reporte.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Registro Mesas</p>
            </a>
            </li>
            <li class="nav-item">
            <a href="../../modulos/administracion/reporte.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Registro Rainbows</p>
            </a>
            </li>

        </ul>
    </li> 
    <li class="nav-item">
    <a href="../../modulos/administracion/tickets.php" class="nav-link">
    <i class="nav-icon fas fa-chart-pie"></i>
        <p> Cuarto Frio <i class="right fas fa-angle-left"></i></p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
        <a href="../../modulos/administracion/reporte.php" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Inventario Cuarto</p>
        </a>
        </li>  
        <li class="nav-item">
            <a href="../../modulos/administracion/reporte.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Egreso ramos con pedido</p>
            </a>
            </li>
            <li class="nav-item">
            <a href="../../modulos/administracion/reporte.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Egreso ramos general</p>
            </a>
            </li>
            <li class="nav-item">
            <a href="../../modulos/administracion/reporte.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tomar Disponible</p>
            </a>
            </li>
            <li class="nav-item">
            <a href="../../modulos/administracion/reporte.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tomar Inventario Mensual</p>
            </a>
            </li>
            <li class="nav-item">
            <a href="../../modulos/administracion/reporte.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Transacciones Cuarto Frio</p>
            </a>
            </li>                  
    </ul>
</li> 
    <li class="nav-item">
        <a href="../../modulos/administracion/tickets.php" class="nav-link">
        <i class="nav-icon fas fa-chart-pie"></i>
            <p> Ventas <i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="../../modulos/administracion/reporte.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pedidos con Stock</p>
            </a>
            </li>  
            <li class="nav-item">
            <a href="../../modulos/administracion/reporte.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pedidos sin Stock</p>
            </a>
            </li> 
            <li class="nav-item">
            <a href="../../modulos/administracion/reporte.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Standing Orders</p>
            </a>
            </li> 
            <li class="nav-item">
            <a href="../../modulos/administracion/reporte.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Proyecciones</p>
            </a>
            </li> 
            <li class="nav-item">
            <a href="../../modulos/administracion/reporte.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manejo Pedidos</p>
            </a>
            </li>                
            <li class="nav-item">
            <a href="../../modulos/administracion/reporte.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Coordinacion Pedidos</p>
            </a>
            </li>  
            <li class="nav-item">
            <a href="../../modulos/administracion/reporte.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Cierre Diario Pedidos</p>
            </a>
            </li>    
            <li class="nav-item">
            <a href="../../modulos/administracion/reporte.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Opciones Pedidos</p>
            </a>
            </li> 
            <li class="nav-item">
            <a href="../../modulos/administracion/reporte.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Ventas Locales</p>
            </a>
            </li> 
        </ul>
    </li>                
</li>

    <li class="nav-header">CONFIGURACIONES</li>         
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-plus-square"></i>
            <p>
              Sistemas
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../../../modulos/sConfiguraciones/Sistemas/usuarios.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Usuarios</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../../modulos/sConfiguraciones/Sistemas/vistas.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Vistas</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../../modulos/sConfiguraciones/Sistemas/botones.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Botones</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../../modulos/sConfiguraciones/Sistemas/tiposu.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tipos Usuarios</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../../modulos/sConfiguraciones/Sistemas/asigvistas.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Asignacion Vistas</p>
              </a>
            </li>
            
          </ul>
        </li>
        <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon far fa-plus-square"></i>
          <p>
            Administracion
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="../../../modulos/sConfiguraciones/Administrativo/articulos.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Articulos</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../../../modulos/sConfiguraciones/Administrativo/clientes.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Clientes</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../../../modulos/sConfiguraciones/Administrativo/clientes.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Sub Clientes</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../../../modulos/sConfiguraciones/Administrativo/clientes.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Proveedores</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../../../modulos/sConfiguraciones/Administrativo/clientes.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Vendedores</p>
            </a>
          </li>
          
        </ul>
      </li>
      <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon far fa-plus-square"></i>
        <p>
          Floricola
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="../../../modulos/sConfiguraciones/Floricola/productos.php" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Productos</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../../../modulos/sConfiguraciones/Floricola/productos.php" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Logistica</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../../../modulos/sConfiguraciones/Floricola/productos.php" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Geolocalizacion</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../../../modulos/sConfiguraciones/Floricola/productos.php" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Areas</p>
          </a>
        </li>
        <li class="nav-item">
        <a href="../../../modulos/sConfiguraciones/Floricola/productos.php" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Variedades</p>
        </a>
      </li>
        
      </ul>
    </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  ';
