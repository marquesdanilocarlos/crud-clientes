export default {
    mapPendencias(pendencias = []) {
        return pendencias.map(this.mapPendencia);
    }
};
