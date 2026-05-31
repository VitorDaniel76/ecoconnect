<?php

class Coleta
{
    private ?int $id_coleta = null;
    private int $id_usuario;
    private int $id_tipo_material;
    private string $quantidade;
    private string $data_coleta;
    private string $periodo;
    private string $endereco;
    private ?string $ponto_referencia;
    private ?string $observacoes;
    private string $status_coleta;

    public function __construct(
        int $id_usuario,
        int $id_tipo_material,
        string $quantidade,
        string $data_coleta,
        string $periodo,
        string $endereco,
        string $ponto_referencia,
        string $observacoes,
        string $status_coleta
    ) {
        $this->id_usuario = $id_usuario;
        $this->id_tipo_material = $id_tipo_material;
        $this->quantidade = $quantidade;
        $this->data_coleta = $data_coleta;
        $this->periodo = $periodo;
        $this->endereco = $endereco;
        $this->ponto_referencia = $ponto_referencia;
        $this->observacoes = $observacoes;
        $this->status_coleta = $status_coleta;
    }

    public static function fromDatabase(array $dados): Coleta
    {
        $coleta = new Coleta(
            $dados['id_usuario'],
            $dados['id_tipo_material'],
            $dados['quantidade'],
            $dados['data_coleta'],
            $dados['periodo'],
            $dados['endereco'],
            $dados['ponto_referencia'],
            $dados['observacoes'],
            $dados['status_coleta']
        );

        $coleta->id_coleta = $dados['id_coleta'];

        return $coleta;
    }

    public function getIdColeta(): ?int
    {
        return $this->id_coleta;
    }

    public function getIdUsuario(): int
    {
        return $this->id_usuario;
    }

    public function getIdTipoMaterial(): int
    {
        return $this->id_tipo_material;
    }

    public function getQuantidade(): string
    {
        return $this->quantidade;
    }

    public function getDataColeta(): string
    {
        return $this->data_coleta;
    }

    public function getPeriodo(): string
    {
        return $this->periodo;
    }

    public function getEndereco(): string
    {
        return $this->endereco;
    }

    public function getPontoReferencia(): string
    {
        return $this->ponto_referencia;
    }

    public function getObservacoes(): string
    {
        return $this->observacoes;
    }

    public function getStatusColeta(): string
    {
        return $this->status_coleta;
    }
}

?>