<div class="clini-infos">
                            <ul>
                                <li><i class="far fa-thumbs-up"></i> 98%</li>
                                <li><i class="far fa-comment"></i> 17 Comentarios</li>
                                <li style="text-transform: capitalize;"> <i class="fas fa-map-marker-alt"></i> <?= $ubicacion_med ?> , Perú</li>
                                <li><i class="far fa-money-bill-alt"></i>
                                    S/ <span class="rango_price"><?=$precio_consulta_med ?></span>
                                    <i class="fas fa-info-circle" data-toggle="tooltip" title="Precio Por Cita"></i>
                                </li>
                                <li><i class="fas fa-certificate"></i> Perfil Verificado</li>
                            </ul>
                        </div>

                        <div class="clinic-booking">
                            <a class="apt-btn btna" id="btna" href="javascript:"
                                data-clipboard-text="<?=$url_base?>perfil-<?=$codigoRef ?>">Compartir Link</a>
                            <a class="apt-btn" href="cita-<?=$codigoRef ?>">Agendar Cita</a>
                        </div>
                    </div>