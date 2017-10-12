<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Repositories\Usuarios\Usuario', 'App\Repositories\Usuarios\UsuarioRepository');
        $this->app->bind('App\Repositories\UsuariosSiguiendo\UsuarioSiguiendo', 'App\Repositories\UsuariosSiguiendo\UsuarioSiguiendoRepository');
        $this->app->bind('App\Repositories\Paises\Pais', 'App\Repositories\Paises\PaisRepository');
        $this->app->bind('App\Repositories\Estados\Estado', 'App\Repositories\Estados\EstadoRepository');
        $this->app->bind('App\Repositories\ImagenesUsuarios\ImagenUsuario', 'App\Repositories\ImagenesUsuarios\ImagenUsuarioRepository');
        $this->app->bind('App\Repositories\Categorias\Categoria', 'App\Repositories\Categorias\CategoriaRepository');
        $this->app->bind('App\Repositories\Disciplinas\Disciplina', 'App\Repositories\Disciplinas\DisciplinaRepository');
        $this->app->bind('App\Repositories\UsuariosDisciplinas\UsuarioDisciplina', 'App\Repositories\UsuariosDisciplinas\UsuarioDisciplinaRepository');
        $this->app->bind('App\Repositories\Grupos\Grupo', 'App\Repositories\Grupos\GrupoRepository');
        $this->app->bind('App\Repositories\GruposDisciplinas\GrupoDisciplina', 'App\Repositories\GruposDisciplinas\GrupoDisciplinaRepository');
        $this->app->bind('App\Repositories\GruposUsuarios\GrupoUsuario', 'App\Repositories\GruposUsuarios\GrupoUsuarioRepository');
        $this->app->bind('App\Repositories\Institucion\Institucion', 'App\Repositories\Institucion\InstitucionRepository');
        $this->app->bind('App\Repositories\InstitucionesUsuarios\InstitucionUsuario', 'App\Repositories\InstitucionesUsuarios\InstitucionUsuarioRepository');
        $this->app->bind('App\Repositories\Ofertas\Oferta', 'App\Repositories\Ofertas\OfertaRepository');
        $this->app->bind('App\Repositories\UsuariosDispuestos\UsuarioDispuesto', 'App\Repositories\UsuariosDispuestos\UsuarioDispuestoRepository');
        $this->app->bind('App\Repositories\Horarios\Horario', 'App\Repositories\Horarios\HorarioRepository');
        $this->app->bind('App\Repositories\Calles\Calle', 'App\Repositories\Calles\CalleRepository');

        $this->app->bind('App\Repositories\Difusion\Difusion', 'App\Repositories\Difusion\DifusionRepository');
        $this->app->bind('App\Repositories\PublicacionUsuario\PublicacionUsuario', 'App\Repositories\PublicacionUsuario\PublicacionUsuarioRepository');
        $this->app->bind('App\Repositories\Reacciones\Reaccion', 'App\Repositories\Reacciones\ReaccionRepository');
        $this->app->bind('App\Repositories\Comentarios\Comentario', 'App\Repositories\Comentarios\ComentarioRepository');

        $this->app->bind('App\Repositories\PublicacionDisciplina\PublicacionDisciplina', 'App\Repositories\PublicacionDisciplina\PublicacionDisciplinaRepository');

        //$this->app->bind('App\Repositories\Respuestas\Respuesta', 'App\Repositories\Respuestas\RespuestaRepository');
        //$this->app->bind('App\Repositories\ComentariosGrupos\ComentarioGrupo', 'App\Repositories\ComentariosGrupos\ComentarioGrupoRepository');
        //$this->app->bind('App\Repositories\ComentariosUsuarios\ComentarioUsuario', 'App\Repositories\ComentariosUsuarios\ComentarioUsuarioRepository');
        //$this->app->bind('App\Repositories\ReaccionesComentarios\ReaccionComentario', 'App\Repositories\ReaccionesComentarios\ReaccionComentarioRepository');
        //$this->app->bind('App\Repositories\ComentariosOfertas\ComentarioOferta', 'App\Repositories\ComentariosOfertas\ComentarioOfertaRepository');
    }
}