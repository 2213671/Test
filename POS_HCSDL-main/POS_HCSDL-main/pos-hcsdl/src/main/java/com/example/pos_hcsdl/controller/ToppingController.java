package com.example.pos_hcsdl.controller;

import com.example.pos_hcsdl.dto.OptionRequest;
import com.example.pos_hcsdl.dto.OptionResponse;
import com.example.pos_hcsdl.dto.ToppingRequest;
import com.example.pos_hcsdl.dto.ToppingResponse;
import com.example.pos_hcsdl.service.ToppingService;
import io.swagger.v3.oas.annotations.tags.Tag;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@Tag(name = "5. Topping Management")
@RestController
@RequestMapping("/topping")
public class ToppingController {
    @Autowired
    private ToppingService toppingService;

    @PostMapping("/create-topping")
    public ToppingResponse createTopping(
            @RequestBody ToppingRequest toppingRequest,
            @RequestHeader(name = "X-Restaurant-Id", required = true) String restaurantId
    ) {
        return toppingService.createTopping(toppingRequest, restaurantId);
    }

    @GetMapping("/restaurant/{id}")
    public List<ToppingResponse> getToppingsByRestaurant(@PathVariable String id) {
        return toppingService.getToppings(id);
    }

    @PutMapping("/{id}")
    public ToppingResponse updateToppingById(@PathVariable String id, @RequestBody ToppingRequest toppingRequest) {
        return toppingService.updateTopping(id, toppingRequest);
    }
}
