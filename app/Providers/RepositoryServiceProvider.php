<?php

namespace App\Providers;

use App\Contracts\{
    PessoaRepositoryInterface,
    PessoaEnderecoRepositoryInterface,
    LotacaoRepositoryInterface,
    UnidadeRepositoryInterface,
    UnidadeEnderecoRepositoryInterface,
    CidadeRepositoryInterface,
    ServidorTemporarioRepositoryInterface,
    ServidorEfetivoRepositoryInterface,
    EnderecoRepositoryInterface,
    FotoRepositoryInterface,
    AuthRepositoryInterface
};
use App\Repositories\{
    PessoaRepository,
    PessoaEnderecoRepository,
    LotacaoRepository,
    UnidadeRepository,
    UnidadeEnderecoRepository,
    CidadeRepository,
    ServidorTemporarioRepository,
    ServidorEfetivoRepository,
    EnderecoRepository,
    FotoRepository,
    AuthRepository
};
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            PessoaRepositoryInterface::class,
            PessoaRepository::class
        );

        $this->app->bind(
            PessoaEnderecoRepositoryInterface::class,
            PessoaEnderecoRepository::class
        );

        $this->app->bind(
            LotacaoRepositoryInterface::class,
            LotacaoRepository::class
        );

        $this->app->bind(
            UnidadeRepositoryInterface::class,
            UnidadeRepository::class
        );

        $this->app->bind(
            UnidadeEnderecoRepositoryInterface::class,
            UnidadeEnderecoRepository::class
        );

        $this->app->bind(
            CidadeRepositoryInterface::class,
            CidadeRepository::class
        );

        $this->app->bind(
            ServidorTemporarioRepositoryInterface::class,
            ServidorTemporarioRepository::class
        );

        $this->app->bind(
            ServidorEfetivoRepositoryInterface::class,
            ServidorEfetivoRepository::class
        );

        $this->app->bind(
            EnderecoRepositoryInterface::class,
            EnderecoRepository::class
        );

        $this->app->bind(
            FotoRepositoryInterface::class,
            FotoRepository::class
        );

        $this->app->bind(
            AuthRepositoryInterface::class,
            AuthRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
