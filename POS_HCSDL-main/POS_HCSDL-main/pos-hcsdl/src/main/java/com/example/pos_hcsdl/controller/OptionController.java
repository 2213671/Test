package com.example.pos_hcsdl.controller;


import com.example.pos_hcsdl.dto.OptionRequest;
import com.example.pos_hcsdl.dto.OptionResponse;
import com.example.pos_hcsdl.dto.ToppingResponse;
import com.example.pos_hcsdl.service.OptionService;
import io.swagger.v3.oas.annotations.tags.Tag;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@Tag(name = "6. Option Management")
@RestController
@RequestMapping("/option")
public class OptionController {

    @Autowired
    private OptionService optionService;

    @PostMapping("/create-option")
    public OptionResponse createOption(
            @RequestBody OptionRequest optionRequest,
            @RequestHeader(name = "X-Restaurant-Id") String restaurantId
    ) {
        return optionService.createOption(optionRequest, restaurantId);
    }

    @GetMapping("/restaurant/{id}")
    public List<OptionResponse> getOptionsByRestaurant(@PathVariable String id) {
        return optionService.getOptionsByRestaurant(id);
    }

    @PutMapping("/{id}")
    public OptionResponse updateOptionById(@PathVariable String id, @RequestBody OptionRequest optionRequest) {
        return optionService.updateOption(id, optionRequest);
    }
}
