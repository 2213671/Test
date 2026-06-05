package com.example.pos_hcsdl.mapper;

import org.mapstruct.Mapper;

import java.util.List;

public interface BaseMapper<E, RQ, RS> {
    RQ entityToRequest(E entity);
    RS entityToResponse(E entity);

    E requestToEntity(RQ rq);
    E responseToEntity(RS rs);

    List<RQ> entityToRequestList(List<E> entityList);
    List<RS> entityToResponseList(List<E> entityList);

    List<E> requestToEntityList(List<RQ> requestList);
    List<RS> responseToEntityList(List<E> responseList);
}
