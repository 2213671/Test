package com.example.pos_hcsdl.mapper;

import com.example.pos_hcsdl.dto.OptionRequest;
import com.example.pos_hcsdl.dto.OptionResponse;
import com.example.pos_hcsdl.entity.Option;
import org.mapstruct.Mapper;
import org.mapstruct.Mapping;
import java.util.List;

@Mapper(componentModel = "spring")
public interface OptionMapper {

    @Mapping(target = "restaurantId", source = "restaurant.id")
    OptionResponse getOptionResponse(Option option);

    Option getOption(OptionRequest optionRequest);

    List<OptionResponse> getOptionResponseList(List<Option> options);
}
