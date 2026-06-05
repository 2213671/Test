package com.example.pos_hcsdl.mapper;

import org.mapstruct.Mapping;

import java.util.List;

public interface BaseResponseMapper<E, RS> {
    RS entityToResponse(E entity);

    E responseToEntity(RS rs);

    List<RS> entityToResponseList(List<E> entityList);

    List<RS> responseToEntityList(List<E> responseList);
}
